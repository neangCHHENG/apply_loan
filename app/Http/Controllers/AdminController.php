<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use App\Helper\RBAC;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailContact;
use App\Models\RoleUser;
use Exception;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Catch_;

class AdminController extends Controller
{
    public function saveUserFontEnd(Request $request)
    {
        try {
            $validation = Validator($request->all(), [
                'name' => 'required|unique:users',
                'email' => 'required|unique:users',
                'position' => ':users',
                'phone' => ':users',
            ]);
            if ($validation->fails()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'icon' => 'error',
                        'result' => $validation->getMessageBag()
                    ]
                );
            }
            $user = new User();
            $user->CardId = $request->CardId;
            $user->name = $request->name;
            $user->username = $request->name;
            $user->position = $request->position;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password = bcrypt('123456');
            $user->maker = session('userid');
            $user->save();

            // Add role to the user
            $roleUser = new RoleUser([
                'role_id' => 2,
                'user_id' => $user->id,
                'maker'   => $user->id,
            ]);
            $roleUser->save();

            // sent Mail
            $mailTo = $request->email;
            $userContact = [
                'subject' => 'MJQE Human Resource',
                'name' => $request->name,
            ];
            Mail::to($mailTo)->send(new MailContact($userContact));

            return response()->json(
                [
                    'status' => 'success',
                    'icon' => 'success',
                    'msg' => 'Sent Message Contact Success!',
                    'data' => [],
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'msg' => 'Get Data Message Contact Index Error!',
                    'result' => $th->getMessage(),
                    'data' => [],
                ]
            );
        }
    }

    #region User
    public function viewUser()
    {
        if (session()->has('AuthToken') == false) {
            return redirect('login');
        }

        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return View('Unauthorize.unauthorized');
        }

        return View('Admin.user');
    }

    public function saveUserImage(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $image_64 = $request->base64img; //your base64 encoded data
        $extension = explode(
            '/',
            explode(':', substr($image_64, 0, strpos($image_64, ';')))[1]
        )[1]; // .jpg .png .pdf

        $image = str_replace('data:image/jpeg;base64,', '', $image_64);
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = $request->userid . '.jpg';
        Storage::disk('local')->put('/public/files/userimg/' . $imageName, base64_decode($image));

        $imagecompress = str_replace('data:image/jpeg;base64,', '', $request->compressbase64);
        $imagecompress = str_replace('data:image/png;base64,', '', $imagecompress);
        $imagecompress = str_replace(' ', '+', $imagecompress);
        $imageName = $request->userid . 'compress.jpg';
        Storage::disk('local')->put('/public/files/userimg/' . $imageName, base64_decode($imagecompress));

        return [
            'result' => 'success',
            'msg' => 'File save success',
            'data' => '',
        ];
    }

    public function viewUserPhoto(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $userid = $request->userid;
        $user = User::find($userid);
        $username = $user->username;

        if (Storage::disk('local')->exists('/public/files/userimg/' . $userid . '.jpg')) {
            $imagebase64 = 'data:image/jpeg;base64,' . base64_encode(Storage::disk('local')->get('/public/files/userimg/' . $userid . '.jpg'));

            return View('Admin.viewUserPhoto')
                ->with('filepath', $userid . '.jpg')
                ->with('imagebase64', $imagebase64)
                ->with('username', $username);
        } else {
            return ['result' => 'error', 'msg' => 'User photo not found', 'data' => ""];
        }
    }

    public function getUserImage(Request $request)
    {
        $photo = "";

        if (session('isGuardian') == 0) {
            if (Storage::disk('local')->exists('/public/files/userimg/' . $request->userid . 'compress.jpg')) {
                $photo = base64_encode(Storage::disk('local')->get('/public/files/userimg/' . $request->userid . 'compress.jpg'));
            } else {
                // $photo = base64_encode(Storage::disk('local')->get('/public/files/userimg/nophoto.jpg'));
                $photo = "";
            }
        } else {
            if (Storage::disk('local')->exists('/public/files/studentimg/' . session('userloginname') . 'compress.jpg')) {
                $photo = base64_encode(Storage::disk('local')->get('/public/files/studentimg/' . session('userloginname') . 'compress.jpg'));
            } else {
                // $photo = base64_encode(Storage::disk('local')->get('/public/files/userimg/nophoto.jpg'));
                $photo = "";
            }
        }

        return response(['result' => 'success', 'msg' => '', 'data' => $photo]);;
    }

    public function maniUsers(Request $request)
    {
        $sql = 'SELECT DISTINCT
        U.id,
        U.name,
        U.username,
        U.email
        FROM users U
        ORDER BY U.name ';

        $users = DB::select($sql);

        $total = count($users);

        $data = array_splice($users, $request->start, $request->end);

        $filter = count($users);

        return ["total" => $total, "filter" => $filter, "data" => $data];
    }

    public function getUsers(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $start = $request->start;
        $length = $request->length;
        $searchValue = $request->search['value'] == null ? "" : $request->search['value'];
        $orderColumn = $request->columns[$request->order[0]['column']]['name']; //Name of order column
        $AscDesc = $request->order[0]['dir']; //asc or desc

        $recordsTotal = 0;
        $recordsFiltered = 0;

        $users = [];
        // condition by user login
        $searchCondition = ($searchValue != "") ? "AND (U.name LIKE ? OR U.username LIKE ? OR email LIKE ? OR U.CardId = ?)" : "";

        $sql = "SELECT U.id, U.CardId, U.name, U.username, U.email
        FROM users U
        WHERE " . ((session('username') != 'Administrator') ? "username = '" . session('username') . "' AND " : "") . "deleted_at IS NULL $searchCondition
        ORDER BY U.$orderColumn $AscDesc";

        $sqlcount = "SELECT COUNT(U.id) AS TotalData FROM users U WHERE " . ((session('username') != 'Administrator') ? "username = '" . session('username') . "' AND " : "") . "deleted_at IS NULL";

        $users = DB::select($sql, ($searchValue != "") ? ['%' . $searchValue . '%', '%' . $searchValue . '%', '%' . $searchValue . '%', $searchValue] : []);
        $totalSQL = DB::select($sqlcount);

        $recordsTotal = $totalSQL[0]->TotalData;
        $recordsFiltered = count($users);

        $users = array_splice($users, $start, $length);
        // condition by user login
        $userobject = array();
        $photo = "";
        $i = $start;

        foreach ($users as $user) {

            $i = $i + 1;

            if (Storage::disk('local')->exists('/public/files/userimg/' . $user->id . 'compress.jpg')) {
                $photo = base64_encode(Storage::disk('local')->get('/public/files/userimg/' . $user->id . 'compress.jpg'));
            } else {
                //$photo = base64_encode(file_get_contents('files/userimg/nophoto.jpg'));
                $photo = "";
            }

            $userobject[] = ["no" => $i, "id" => $user->id, "CardId" => $user->CardId, "name" => $user->name, "username" => $user->username, "email" => $user->email, "photo" => $photo];
        }

        return ['data' => $userobject, 'draw' => $request->draw, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered];
    }

    public function getUserRole(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $role = DB::select(
            'SELECT DISTINCT R.*,? userid,CASE WHEN RU.user_id IS NULL THEN 0 ELSE 1 END AS permit FROM
        roles R LEFT OUTER JOIN role_user RU ON R.id=RU.role_id AND RU.user_id=?',
            [$request->userid, $request->userid]
        );

        return ['result' => 'success', 'msg' => '', 'data' => $role];
    }

    public function assignRole(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $userid = $request->userid;
        $roleid = $request->roleid;
        $checked = $request->checked;
        $user = User::find($userid);
        $role = Role::find($roleid);

        if ($checked == 'true') {
            //$data = 'add';
            $findrole = DB::select(
                'SELECT * FROM role_user WHERE user_id=? AND role_id=?',
                [$userid, $roleid]
            );

            if (!$findrole) {
                // DB::insert(
                //     'INSERT INTO role_user`(`role_id, user_id,maker, created_at, `updated_at`) VALUES (?,?,?,?,?)',
                //     [$roleid, $userid, session('userid'), Carbon::now(), Carbon::now()]
                // );
                $newRoleUser = new RoleUser();
                $newRoleUser->role_id = $roleid;
                $newRoleUser->user_id = $userid;
                $newRoleUser->maker = session('userid');
                $newRoleUser->save();
            }

            return [
                'result' => 'success',
                'msg' => $role->name . ' have been assign to ' . $user->name,
                'data' => '',
            ];
        } else {
            // DB::delete('DELETE FROM role_user WHERE user_id=? AND role_id=?', [
            //     $userid,
            //     $roleid,
            // ]);

            DB::update('update role_user set delby=? where user_id=? and role_id=?', [session('userid'), $userid, $roleid]);

            $roleUser = RoleUser::where('user_id', $userid)->where('role_id', $roleid)->first();
            $roleUser->delete();
            return [
                'result' => 'warning',
                'msg' => $role->name . ' have been remove from ' . $user->name,
                'data' => '',
            ];
        }
    }

    public function editUser(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $user = User::find($request->id);

        return ['result' => 'success', 'msg' => '', 'data' => $user];
    }

    public function updateUser(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }
        $request->validate(['name' => 'required', 'username' => 'required']);

        try {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->CardId = $request->CardId;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->maker = session('userid');
            $user->save();
        } catch (QueryException $e) {
            return [
                'result' => 'error',
                'msg' => 'Error while save user',
                'data' => $e,
            ];
        }


        if (Storage::disk('local')->exists('/public/files/userimg/' . $user->id . 'compress.jpg')) {
            $photo = base64_encode(Storage::disk('local')->get('/public/files/userimg/' . $user->id . 'compress.jpg'));
        } else {
            //$photo = base64_encode(file_get_contents('files/userimg/nophoto.jpg'));
            $photo = "";
        }
        $userobject = ["no" => 0, "id" => $user->id, "name" => $user->name, "CardId" => $user->CardId, "username" => $user->username, "email" => $user->email, "photo" => $photo];

        return [
            'result' => 'success',
            'msg' => 'User : ' . $user->username . ' have been update',
            'data' => $userobject,
        ];
    }

    public function resetPassword(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $user = User::find($request->id);
        $user->password = bcrypt($request->password);
        $user->maker = session('userid');
        $user->save();

        $userobject = ["no" => 0, "id" => $user->id, "name" => $user->name, "CardId" => $user->CardId, "username" => $user->username, "email" => $user->email, "photo" => null];

        return [
            'result' => 'success',
            'msg' => 'User : ' . $user->username . ' have been change password',
            'data' => $userobject,
        ];
    }

    public function saveUser(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        try {


            $validation = Validator($request->all(), [
                'CardId' => 'required',
                'name' => 'required',
                'username' => 'required',
                'email' => 'required',
            ]);
            if ($validation->fails()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'icon' => 'error',
                        'result' => $validation->getMessageBag()
                    ]
                );
            }

            $user = new User();
            $user->CardId = $request->CardId;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt('123456');
            $user->maker = session('userid');
            $user->save();

            $userobject = ["no" => 0, "id" => $user->id, "name" => $user->name, "CardId" => $user->CardId, "username" => $user->username, "email" => $user->email, "photo" => null];

            return [
                'result' => 'success',
                'msg' => 'User : ' . $user->username . ' have been save',
                'data' => $userobject,
            ];
        } catch (QueryException $e) {
            return [
                'result' => 'error',
                'msg' => 'Error while save user',
                'data' => $e,
            ];
        }
    }

    public function deleteUser(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $user = User::find($request->id);
        $user->delby = session('userid');
        $user->save();
        $user->delete();

        return [
            'result' => 'success',
            'msg' => 'User : ' . $user->username . ' have been save',
            'data' => $user,
        ];
    }

    #endregion

    #region Permission
    public function viewPermission()
    {
        if (session()->has('AuthToken') == false) {
            return redirect('login');
        }

        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return View('Unauthorize.unauthorized');
        }

        return View('Admin.permission');
    }

    public function getpermissionlist()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $permissions = RBAC::getPermissionName(); // In Controller

        foreach ($permissions as $permissionarray) {
            if (array_key_exists('controller', $permissionarray)) {
                $route = $permissionarray['controller'];

                if (Str::contains($route, 'App\\Http\\Controllers\\')) {
                    $routefragment = explode('@', $route);
                    $permission = Str::replace('Controller', '', Str::replace('App\\Http\\Controllers\\', '', $routefragment[0])) . '-' . $routefragment[1];
                    $p = null;
                    $p = Permission::where('name', $permission)->first();

                    if ($p == null) {
                        $newP = new Permission();
                        $newP->name = $permission;
                        $newP->module = Str::replace('App\\Http\\Controllers\\', '', $routefragment[0]);
                        $newP->remark = '';
                        $newP->isExist = true;
                        $newP->save();
                    }
                }
            }
        }

        $apppermission = Permission::all();

        return ['result' => 'success', 'msg' => '', 'data' => $apppermission];
    }
    #Display Menu Letf Panal
    public function isAccessible(Request $request)
    {
        $permissions = $request->permissiondata;
        $response = [];
        foreach ($permissions as $permission) {
            $accessible = RBAC::isAccessible($permission['permission']);
            $response[] = ["index" => $permission['index'], "permission" => $permission['permission'], "accessible" => $accessible];
        }

        return response(['result' => 'success', 'msg' => '', 'data' => $response]);;
    }

    #endregion

    #region role
    public function viewroles()
    {
        if (session()->has('AuthToken') == false) {
            return redirect('login');
        }

        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return View('Unauthorize.unauthorized');
        }

        return View('Admin.roles');
    }

    public function getrolelist()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $roles = Role::all();
        return ['result' => 'success', 'msg' => '', 'data' => $roles];
    }

    public function saverole(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $validation = Validator($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'result' => $validation->getMessageBag()
                ]
            );
        }

        $role = new Role();
        $role->name = $request->name;
        $role->isAdmin = $request->isAdmin == 'true' ? true : false;
        $role->maker = session('userid');
        $role->description = $request->description;
        $role->save();

        return [
            'result' => 'success',
            'msg' => 'Role : ' . $role->name . ' have been save',
            'data' => $role,
        ];
    }

    public function editrole(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $role = Role::find($request->id);

        return [
            'result' => 'success',
            'msg' => 'Role : ' . $role->name . ' have been save',
            'data' => $role,
        ];
    }

    public function updaterole(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $role = Role::find($request->id);
        $role->name = $request->name;
        $role->isAdmin = $request->isAdmin == 'true' ? true : false;
        $role->description = $request->description;
        $role->maker = session('userid');
        $role->save();

        return [
            'result' => 'success',
            'msg' => 'Role : ' . $role->name . ' have been update',
            'data' => $role,
        ];
    }

    public function deleterole(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $role = Role::find($request->id);
        $rolename = $role->name;
        $role->delby = session('userid');
        $role->save();
        $role->delete();

        return [
            'result' => 'success',
            'msg' => 'Role : ' . $rolename . ' have been deleted',
            'data' => '',
        ];
    }

    public function getrolepermission(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $roleid = $request->roleid;

        $permissions = DB::select(
            'SELECT P.*,? role_id,CASE WHEN RP.role_id IS NULL THEN 0 ELSE 1 END AS permit FROM permissions P LEFT JOIN role_permission RP ON P.id=RP.permission_id AND RP.role_id=?;',
            [$roleid, $roleid]
        );

        return ['result' => 'success', 'msg' => '', 'data' => $permissions];
    }

    public function assignPermission(Request $request)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $permit = $request->permit == 'true' ? true : false;
        $permissionid = $request->permissionid;
        $role_id = $request->role_id;
        $role = Role::find($role_id);
        $permission = Permission::find($permissionid);

        $RP = DB::select(
            'SELECT * FROM `role_permission` WHERE `permission_id`=? AND `role_id`=?',
            [$permissionid, $role_id]
        );

        if ($permit == true) {
            if ($RP == null) {
                DB::insert(
                    'INSERT INTO `role_permission`(`role_id`, `permission_id`,`maker`, `created_at`, `updated_at`) VALUES (?,?,?,?,?)',
                    [$role_id, $permissionid, session('userid'), Carbon::now(), Carbon::now()]
                );

                return [
                    'result' => 'success',
                    'msg' =>
                    'Permission ' .
                        $permission->name .
                        ' have been add to ' .
                        $role->name,
                    'data' => '',
                ];
            } else {
                return [
                    'result' => 'success',
                    'msg' =>
                    'Permission ' .
                        $permission->name .
                        ' have been add to ' .
                        $role->name,
                    'data' => '',
                ];
            }
        } else {
            if ($RP != null) {
                DB::delete(
                    'DELETE FROM `role_permission` WHERE `role_id`=? AND `permission_id`=?',
                    [$role_id, $permissionid]
                );

                return [
                    'result' => 'warning',
                    'msg' =>
                    'Permission ' .
                        $permission->name .
                        ' have been remove from ' .
                        $role->name,
                    'data' => '',
                ];
            } else {
                return [
                    'result' => 'warning',
                    'msg' =>
                    'Permission ' .
                        $permission->name .
                        ' have been remove from ' .
                        $role->name,
                    'data' => '',
                ];
            }
        }
    }
    #endregion
}
