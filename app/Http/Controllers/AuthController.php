<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\UserCampus;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return View('Auth.login');
    }

    public function getFormToken()
    {
        return session('_token');
    }

    public function authenticate(Request $request)
    {
        $user = User::where('username', $request->username)->orWhere('CardId', $request->username)->first(); //username is uniqure

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'result' => 'error',
                'msg' => 'Invalid user name or password',
                'data' => '',
            ]);
        }

        //$user->tokens()->delete();
        $token = $user->createToken('myapptoken')->plainTextToken;
        //Carbon::now(new DateTimeZone('Asia/Phnom_Penh'));
        $sessionlife = Config::get('session.lifetime');

        $isGuardian = 0;
        /*$GuardianRole = DB::select('SELECT U.id FROM roles R INNER JOIN role_user RU ON R.id=RU.role_id AND R.name=?
        INNER JOIN users U ON U.id=RU.user_id AND U.id=?', ['Guardian', $user->id]);

        if (count($GuardianRole) > 0) {
            $isGuardian = 1;
        }*/

        Session(['SessionEnd' => Carbon::now(new DateTimeZone('Asia/Phnom_Penh'))->addMinutes($sessionlife)]);
        Session(['AuthToken' => $token]);
        Session(['userid' => $user->id]);
        Session(['username' => $user->name]);
        Session(['userloginname' => $user->username]);
        Session(['isGuardian' => $isGuardian]);

        $roles = DB::select('select r.id,r.isAdmin from role_user ru inner join roles r on ru.role_id=r.id where ru.user_id=?', [$user->id]);
        Session(['userroles' => json_encode($roles)]);

        return response(['result' => 'success', 'msg' => '', 'data' => '', 'mobile' => $token]);
    }

    public function logOut(Request $request)
    {
        $userid = auth()->user()->id;
        $user = User::find($userid);
        $user->tokens()->delete();

        $request->session()->forget('AuthToken');

        return redirect('login');
    }

    public function resetPassword(Request $request)
    {
        if (session()->has('AuthToken') == false) {
            return ['result' => 'error', 'msg' => 'Loging Required', 'data' => ''];
        }

        $user = User::find(session('userid'));
        $user->password = bcrypt($request->password);
        $user->maker = session('userid');
        $user->save();



        return [
            'result' => 'success',
            'msg' => 'Password have been reset',
            'data' => '',
        ];
    }

    public function destroysession()
    {
        session_destroy();
    }

    #region google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleuser = Socialite::driver('google')->user();
            $user = User::where('google_id', $googleuser->id)->orWhere('username', $googleuser->email)->first();

            if ($user) {
                //Login//
                $token = $user->createToken('myapptoken')->plainTextToken;
                $sessionlife = Config::get('session.lifetime');
                $isGuardian = 0;
                /*$GuardianRole = DB::select('SELECT U.id FROM roles R INNER JOIN role_user RU ON R.id=RU.role_id AND R.name=?
                INNER JOIN users U ON U.id=RU.user_id AND U.id=?', ['Guardian', $user->id]);

                if (count($GuardianRole) > 0) {
                    $isGuardian = 1;
                }*/

                if ($user->google_id == null) {
                    $user->google_id = $googleuser->id;
                    $user->save();
                }

                Session(['SessionEnd' => Carbon::now(new DateTimeZone('Asia/Phnom_Penh'))->addMinutes($sessionlife)]);
                Session(['AuthToken' => $token]);
                Session(['userid' => $user->id]);
                Session(['username' => $user->name]);
                Session(['userloginname' => $user->username]);
                //Session(['permitCampus' => $user->username]);
                Session(['isGuardian' => $isGuardian]);
                /////////

                return redirect('/admin/home');
            } else {
                $newUser = User::create([
                    'name' => $googleuser->name,
                    'email' => $googleuser->email,
                    'username' => $googleuser->email,
                    'google_id' => $googleuser->id,
                    'password' => bcrypt('secretM@5ter')
                ]);

                //Login//
                $token = $newUser->createToken('myapptoken')->plainTextToken;
                $sessionlife = Config::get('session.lifetime');
                $isGuardian = 0;
                $GuardianRole = DB::select('SELECT U.id FROM roles R INNER JOIN role_user RU ON R.id=RU.role_id AND R.name=?
                INNER JOIN users U ON U.id=RU.user_id AND U.id=?', ['Guardian', $newUser->id]);

                if (count($GuardianRole) > 0) {
                    $isGuardian = 1;
                }

                Session(['SessionEnd' => Carbon::now(new DateTimeZone('Asia/Phnom_Penh'))->addMinutes($sessionlife)]);
                Session(['AuthToken' => $token]);
                Session(['userid' => $newUser->id]);
                Session(['username' => $newUser->name]);
                Session(['userloginname' => $newUser->username]);
                Session(['isGuardian' => $isGuardian]);
                /////////


                return redirect('/admin/home');
            }
        } catch (Exception $e) {
            //dd($e->getMessage());
            dd('callback error');
        }
    }
    #endregion
}
