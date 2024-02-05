<?php

namespace App\Http\Controllers;

use App\Models\PostJob;
use App\Models\Position;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Helper\RBAC;
use App\Models\VacancyType;

class PostJobController extends Controller
{

    protected function dataList()
    {
        if (session('username') != 'Administrator') {
            $data = PostJob::join('positions', 'post_jobs.position', '=', 'positions.id')
                ->join('locations', 'post_jobs.location', '=', 'locations.id')
                ->join('vacancy_types', 'post_jobs.vacancy_type', '=', 'vacancy_types.id')
                ->join('career_levels', 'post_jobs.career_level', '=', 'career_levels.id')
                ->join('language_skills', 'post_jobs.language_skills', '=', 'language_skills.id')
                ->join('qualifications', 'post_jobs.qualification', '=', 'qualifications.id')
                ->join('companies', 'post_jobs.company', '=', 'companies.id')
                ->leftjoin('departments', 'positions.department', '=', 'departments.id')
                ->select(
                    'post_jobs.id',
                    'positions.title_en as position',
                    'positions.department',
                    'departments.title_en as department_en',
                    'locations.title_en as location',
                    'vacancy_types.title_en as vacancy_type',
                    'positions.experience as experience',
                    'positions.description_en as description',
                    'post_jobs.end_date',
                    'post_jobs.start_date',
                    'post_jobs.note',
                    'post_jobs.create_by',
                    'post_jobs.created_at',
                    'post_jobs.thumbnail',
                    'post_jobs.location as location_id',
                    'post_jobs.position as position_id',
                    'post_jobs.vacancy_type as vacancy_type_id',
                    'post_jobs.hiring',
                    'post_jobs.offered_salary',
                    'qualifications.title_en as qualification',
                    'post_jobs.qualification as qualification_id',
                    'post_jobs.language_skills as language_skills_id',
                    'companies.title_en as company',
                    'post_jobs.company as company_id',
                    'post_jobs.career_level as career_level_id',
                    'post_jobs.urgent',
                    'language_skills.title_en as language_skills',
                    'career_levels.title_en as career_level'
                )
                ->where('post_jobs.create_by', '=', session('username'))
                ->where('post_jobs.state', '!=', 0)
                ->get();
            return $data;
        } else {
            $data = PostJob::join('positions', 'post_jobs.position', '=', 'positions.id')
                ->join('locations', 'post_jobs.location', '=', 'locations.id')
                ->join('vacancy_types', 'post_jobs.vacancy_type', '=', 'vacancy_types.id')
                ->join('career_levels', 'post_jobs.career_level', '=', 'career_levels.id')
                ->join('language_skills', 'post_jobs.language_skills', '=', 'language_skills.id')
                ->join('qualifications', 'post_jobs.qualification', '=', 'qualifications.id')
                ->join('companies', 'post_jobs.company', '=', 'companies.id')
                ->leftjoin('departments', 'positions.department', '=', 'departments.id')
                ->select(
                    'post_jobs.id',
                    'positions.title_en as position',
                    'positions.department',
                    'departments.title_en as department_en',
                    'locations.title_en as location',
                    'vacancy_types.title_en as vacancy_type',
                    'positions.experience as experience',
                    'positions.description_en as description',
                    'post_jobs.end_date',
                    'post_jobs.start_date',
                    'post_jobs.note',
                    'post_jobs.create_by',
                    'post_jobs.created_at',
                    'post_jobs.thumbnail',
                    'post_jobs.location as location_id',
                    'post_jobs.position as position_id',
                    'post_jobs.vacancy_type as vacancy_type_id',
                    'post_jobs.hiring',
                    'post_jobs.offered_salary',
                    'qualifications.title_en as qualification',
                    'post_jobs.qualification as qualification_id',
                    'post_jobs.language_skills as language_skills_id',
                    'companies.title_en as company',
                    'post_jobs.company as company_id',
                    'post_jobs.career_level as career_level_id',
                    'post_jobs.urgent',
                    'language_skills.title_en as language_skills',
                    'career_levels.title_en as career_level'
                )
                ->where('post_jobs.state', '!=', 0)
                ->get();
            return $data;
        }
    }

    public function view(PostJob $PostJob)
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authorized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        return View('AdminMenu.PostJob.index')
            ->with('PostJob',  $PostJob);
    }

    public function create()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }
        return View('AdminMenu.PostJob.form');
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
                'position' => 'required:post_jobs',
                'company' => 'required:post_jobs',
                'location' => 'required:post_jobs',
                'vacancy_type' => 'required:post_jobs',
                'hiring' => 'required:post_jobs',

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
            PostJob::create($data);
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

    public function update(Request $request, PostJob $post_job)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }

            $validation = Validator::make($request->all(), [
                'position' => 'required:post_jobs',
                'company' => 'required:post_jobs',
                'location' => 'required:post_jobs',
                'vacancy_type' => 'required:post_jobs',
                'hiring' => 'required:post_jobs',

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

            $post_job->update($data);

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

    public function destroy(PostJob $post_job)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }
            $post_job['state'] = 0;
            $post_job->update();


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

    public function getPositionList()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $list = DB::select(
            'SELECT p.id, p.title_en, d.title_en as department_title FROM positions p inner join departments d on p.department=d.id WHERE p.state=1'
        );

        return ['result' => 'success', 'msg' => '', 'data' => $list];
    }

    public function getLocationList()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $list = DB::select(
            'SELECT id, title_en FROM locations WHERE state=1'
        );

        return ['result' => 'success', 'msg' => '', 'data' => $list];
    }

    public function getVacancyTypeList()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $list = DB::select(
            'SELECT id, title_en FROM vacancy_types WHERE state=1'
        );

        return ['result' => 'success', 'msg' => '', 'data' => $list];
    }

    public function getQualificationList()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $list = DB::select(
            'SELECT id, title_en FROM qualifications WHERE state=1'
        );

        return ['result' => 'success', 'msg' => '', 'data' => $list];
    }

    public function getCompanyList()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $list = DB::select(
            'SELECT id, title_en FROM companies WHERE state=1'
        );

        return ['result' => 'success', 'msg' => '', 'data' => $list];
    }

    public function getLanguSkillList()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $list = DB::select(
            'SELECT id, title_en, title_kh FROM language_skills WHERE state=1'
        );

        return ['result' => 'success', 'msg' => '', 'data' => $list];
    }

    public function getCareerLevelList()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }

        $list = DB::select(
            'SELECT id, title_en, title_kh FROM career_levels WHERE state=1'
        );

        return ['result' => 'success', 'msg' => '', 'data' => $list];
    }
}
