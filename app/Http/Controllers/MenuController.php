<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Menu;
use App\Helper\RBAC;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Helper\MenuHelper;
use App\Helper\Util;
use App\Models\CategoryArticle;
use App\Models\CategoryEvent;
use App\Models\Type;
use App\Models\Type_config;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{

    public function dataList($type = 'Top', $getList = 'type')
    {
        $data = Menu::where('state', 1)->with('article')->where('type', $type);

        if ($getList == 'all') {
            return  $data->orderBy('left')->get();
        }
        return  $data->where('is_root', 0)->orderBy('left')->get();
    }
    public function view()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }
        $type = Type::where('state', 1)->get();
        foreach ($type as $types) {
            MenuHelper::root($types->name);
        }
        return View('AdminMenu.Menu.index');
    }

    public function create($id)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }
        $update = null;
        if ($id != 0) {
            $update = Menu::find($id);
        }
        return View('AdminMenu.Menu.form')
            ->with('menu', $update)
            ->with('type', Type::where('state', 1)->get())
            ->with('parent_menu', $this->dataList());
    }
    public function edit($id)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }
        return response()->json(
            [
                'status' => 'success',
                'icon' => 'success',
                'data' => Menu::where('id', $id)->with('article')->first(),
                'config_type' => Type_config::all(), // get name
                'category' => CategoryArticle::all(), // get name

            ]
        );
    }

    public function indexList($type)
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
                    'data' => $this->dataList($type),
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
    public function selectMenu(Request $request)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }
            // dd($request->id);
            return response()->json(
                [
                    'status' => 'success',
                    'icon' => 'success',
                    'data' => MenuHelper::eligbile_parents($request->type, $request->id),
                    // 'data' => $this->dataList($request->type, 'all'),
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

    public function index()
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }

            // create root menu by type
            $type = Type::where('state', 1)->get();
            foreach ($type as $types) {
                MenuHelper::root($types->name);
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
                    'result' => $th->getMessage(),
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

            $valid = [
                'menu_en'       => 'required',
                'slug'          => 'required',
                'menu_kh'       => 'required',
                'state'         => 'required',
                'parent_id'     => 'required',
                'menu_type'     => 'required',
            ];

            $validation = Validator($request->all(), $valid);
            if ($validation->fails()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'icon' => 'error',
                        'result' => $validation->getMessageBag()
                    ]
                );
            }
            // return $request->all();
            $data = Util::array_to_object($request->all());
            $data->position = 0;
            $data->slug = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\ \  \|\\\]/", "-", strtolower($request->menu_en));
            $data->created_by = Auth::user()->name; //todo
            $data->param2 = '';
            MenuHelper::insert($data);

            return response()->json(
                [
                    'status' => 'success',
                    'icon' => 'success',
                    'data' => $this->dataList(),
                ]
            );
        } catch (\Throwable $th) {
            Log::error('Insert to menu');
            Log::error($th);

            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'msg' => 'Insert Data Error : ' . $th->getMessage(),
                    'data' => [],
                ]
            );
        }
    }

    public function show(Menu $menu)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        //
    }

    public function update(Request $request, Menu $menu)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }

            $valid = [
                'menu_en'       => 'required',
                // 'slug'          => 'required|unique:menus,slug,' . $menu->id,
                'menu_kh'       => 'required',
                'state'         => 'required',
                'parent_id'     => 'required',
                'menu_type'     => 'required',
            ];
            $validation = Validator($request->all(), $valid);
            if ($validation->fails()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'icon' => 'error',
                        'result' => $validation->getMessageBag()
                    ]
                );
            }

            $data = Util::array_to_object($request->all());
            $data->id = $menu->id;
            $data->slug = $menu->slug;
            // $data->slug = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\ \  \|\\\]/", "-", strtolower($request->menu_en));
            $data->position = 0;
            $data->updated_by = Auth::user()->name; //todo
            $data->param2 = '';
            MenuHelper::update($data);

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
                    'msg' => 'Update data Error!',
                    'result' => $th->getMessage(),
                    'data' => [],
                ]
            );
        }
    }

    public function destroy(Menu $menu)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }

            MenuHelper::delete($menu->id);

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
