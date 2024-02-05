<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helper\RBAC;
use Illuminate\Support\Facades\Route;

class ContactSubmitController extends Controller
{
    protected function dataList()
    {
        return ContactSubmit::get();
    }

    public function view()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }
        return View('AdminMenu.ContactSubmit.index');
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
                    'msg' => 'Get Data Menu Index Error!',
                    'result' => $th,
                    'data' => [],
                ]
            );
        }
    }

    public function contactSubmit(Request $request)
    {
        try {
            $validation = Validator($request->all(), [
                'name' => 'required',
                'email' => 'required|unique:contact_submits',
                'subject' => 'required',
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


            if ($file = $request->hasFile('thumbnail_form')) {
                $file = $request->file('thumbnail_form');
                $fileName = $file->getClientOriginalName();
                $randomized = rand();
                $thumbnail = $randomized . "_" . $fileName;
                $destinationPath = public_path() . '/thumbnails';
                $file->move($destinationPath, $thumbnail);
            }
            if ($fileCv = $request->hasFile('fileCv_form')) {
                $fileCv = $request->file('fileCv_form');
                $fileCvName = $fileCv->getClientOriginalName();
                $randomized = rand();
                $fileCvthumbnail = $randomized . "_" . $fileCvName;
                $destinationPath = public_path() . '/fileCv_forms';
                $fileCv->move($destinationPath, $fileCvthumbnail);
            }

            $request["thumbnail"] = $thumbnail;
            $request["fileCv"] = $fileCvthumbnail;
            ContactSubmit::create($request->all());

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

    public function getLocationList()
    {
        $list = DB::select(
            'SELECT id, title_en, title_kh FROM locations WHERE state=1'
        );

        return ['result' => 'success', 'msg' => '', 'data' => $list];
    }
    public function getSpecialismList()
    {
        $list = DB::select(
            'SELECT id, title_en, title_kh FROM departments WHERE state=1'
        );

        return ['result' => 'success', 'msg' => '', 'data' => $list];
    }


    public function getVacancytypeList()
    {
        $list = DB::select(
            'SELECT id, title_en, title_kh FROM vacancy_types WHERE state=1'
        );

        return ['result' => 'success', 'msg' => '', 'data' => $list];
    }
}
