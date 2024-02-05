<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Helper\RBAC;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PositionController extends Controller
{

    protected function dataList()
    {
        return Position::join('departments', 'positions.department', '=', 'departments.id')
            ->select(
                'positions.id',
                'positions.title_en',
                'positions.title_kh',
                'positions.department as department_id',
                'departments.title_en as department_en',
                'departments.title_kh as department_kh',
                'positions.experience',
                'positions.note',
                'positions.create_by',
                'positions.created_at',
                'positions.description_en',
                'positions.description_kh',
            )->where('positions.state', '!=', 0)->get();
    }

    public function view()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }
        return View('AdminMenu.Position.index');
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

    public function store(Request $request)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }

            $validation = Validator::make($request->all(), [
                'title_en' => 'required|unique:positions,title_en,NULL,id,department,' . $request->input('department'),
                'title_kh' => 'required|unique:positions,title_kh,NULL,id,department,' . $request->input('department'),
                'department' => 'required',
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
            $data = $request->all();
            $data['create_by'] = session('username');
            Position::create($data);
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

    public function update(Request $request, Position $position)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }

            $validation = Validator::make($request->all(), [
                'title_en' => 'required|unique:positions,title_en,' . $position->id . ',id,department,' . $request->input('department'),
                'title_kh' => 'required|unique:positions,title_kh,' . $position->id . ',id,department,' . $request->input('department'),
                'department' => 'required',
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

            $data = $request->all();
            $data['create_by'] = session('username');

            $position->update($data);

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

    public function destroy(Position $position)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }
            $position['state'] = 0;
            $position->update();


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
                    'result' => $th,
                    'data' => [],
                ]
            );
        }
    }

    public function getDepartmentList()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $list = DB::select(
            'SELECT id,title_en, title_kh FROM departments WHERE state=1'
        );

        return ['result' => 'success', 'msg' => '', 'data' => $list];
    }
}
