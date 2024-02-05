<?php

namespace App\Http\Controllers;

use App\Helper\RBAC;
use App\Models\PopupHome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class PopupHomeController extends Controller
{
    protected function dataList()
    {
        return PopupHome::where('state', 1)->get();
    }

    public function view()
    {

        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }
        return View('AdminMenu.PopupHome.index');
    }
    public function activeBtn($id)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }

            $update_details = array(
                'active' => 0,
            );

            DB::table('popup_homes')
                ->where('state', 1)
                ->update($update_details);

            PopupHome::find($id)->update(['active' => 1]);

            return response()->json(
                [
                    'status' => 'success',
                    'icon' => 'success',
                    'data' => $this->dataList(),
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'msg' => 'Get Data Popup Home Index Error!',
                    'result' => $th,
                    'data' => [],
                ]
            );
        }
    }

    public function index()
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }
            return response()->json(
                [
                    'status' => 'success',
                    'icon' => 'success',
                    'data' => $this->dataList(),
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'msg' => 'Get Data Popup Home Index Error!',
                    'result' => $th,
                    'data' => [],
                ]
            );
        }
    }

    public function store(Request $request)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }

            $validation = Validator($request->all(), [
                'image' => 'required',
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

            PopupHome::create($request->all());

            return response()->json(
                [
                    'status' => 'success',
                    'icon' => 'success',
                    'data' => $this->dataList(),
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'msg' => 'Get Data Menu Index Error!',
                    'result' => $th->getMessage(),
                    'data' => [],
                ]
            );
        }
    }

    public function show(PopupHome $popupHome)
    {
        //
    }

    public function update(Request $request, PopupHome $popupHome)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }

            $validation = Validator($request->all(), [
                'image' => 'required',
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

            $popupHome->update($request->all());

            return response()->json(
                [
                    'status' => 'success',
                    'icon' => 'success',
                    'data' => $this->dataList(),
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'msg' => 'Get Data Menu Index Error!',
                    'result' => $th->getMessage(),
                    'data' => [],
                ]
            );
        }
    }

    public function destroy(PopupHome $popupHome)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }
            $popupHome['state'] = 0;
            $popupHome->update();


            return response()->json(
                [
                    'status' => 'success',
                    'icon' => 'success',
                    'data' => $this->dataList(),
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'msg' => 'Delete Data Error!',
                    'result' => $th->getMessage(),
                    'data' => [],
                ]
            );
        }
    }
}
