<?php

namespace App\Http\Controllers;

use App\Models\PostJob;
use App\Helper\MenuFrontendHelper;
use Illuminate\Http\Request;
use App\Helper\VisitorHelper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $url = url()->current();
        $slug = explode('/', $url);
        $slugLanguage = $slug[3];
        if (array_key_exists('kh', Config::get('languages'))) {
            Session::put('applocale', 'kh');
            App::setLocale(Session()->get('applocale'));
        }
        return $this->returnView($request->search, $slugLanguage, $title = $request->input('title'), $specialism = $request->input('specialism'), $location = $request->input('locations'), $vacancy_type = $request->input('vacancy_type'));
    }

    public function searchEn(Request $request)
    {
        $url = url()->current();
        $slug = explode('/', $url);
        $slugLanguage = $slug[4];

        if (array_key_exists('en', Config::get('languages'))) {
            Session::put('applocale', 'en');
            App::setLocale(Session()->get('applocale'));
        }
        return $this->returnView($request->search, $slugLanguage, $title = $request->input('title'), $specialism = $request->input('specialism'), $location = $request->input('locations'), $vacancy_type = $request->input('vacancy_type'));
    }

    protected function returnView($search, $slugLanguage, $title, $specialism, $location, $vacancy_type)
    {
        $countDate = VisitorHelper::visitor();
        $menuFrontend = MenuFrontendHelper::menuFrontend();
        $topMenu = $menuFrontend['topMenu'];
        $mainMenu = $menuFrontend['mainMenu'];
        $bottomMenu = $menuFrontend['bottomMenu'];
        $menuFooterItems = $menuFrontend['menuFooterItems'];
        $currentDate = now()->format('Y-m-d');
        $data = PostJob::join('positions', 'post_jobs.position', '=', 'positions.id')
            ->join('locations', 'post_jobs.location', '=', 'locations.id')
            ->join('qualifications', 'post_jobs.qualification', '=', 'qualifications.id')
            ->join('companies', 'post_jobs.company', '=', 'companies.id')
            ->leftjoin('departments', 'positions.department', '=', 'departments.id')
            ->leftjoin('vacancy_types', 'post_jobs.vacancy_type', '=', 'vacancy_types.id')
            ->select(
                'post_jobs.id',
                'positions.title_en as position_en',
                'positions.title_kh as position_kh',
                'departments.title_en as department_en',
                'departments.title_kh as department_kh',
                'locations.title_en as location_en',
                'locations.title_kh as location_kh',
                'vacancy_types.title_en as vacancy_en',
                'vacancy_types.title_kh as vacancy_kh',
                'positions.experience',
                'positions.description_en as description_en',
                'positions.description_kh as description_kh',
                'post_jobs.end_date',
                'post_jobs.start_date',
                'post_jobs.thumbnail',
                'post_jobs.hiring',
                'post_jobs.offered_salary',
                'post_jobs.career_level',
                'post_jobs.urgent',
                'qualifications.title_en as qualification_en',
                'qualifications.title_kh as qualification_kh',
                'post_jobs.language_skills',
                'companies.title_en as company_en',
                'companies.title_kh as company_kh',
                'companies.thumbnail as thumbnail_com',
                'companies.facebook_url',
                'companies.external_url',
                'companies.note'
            )
            ->where(function ($query) use ($title) {
                $query->where('positions.title_en', 'like', '%' . $title . '%')
                    ->orWhere('positions.title_kh', 'like', '%' . $title . '%');
            })
            ->where('positions.department', '=', $specialism)
            ->where('post_jobs.location', '=', $location)
            ->where('post_jobs.state', '!=', 0)
            ->where('post_jobs.start_date', '<=', $currentDate)
            ->where('post_jobs.end_date', '>=', $currentDate);
        if ($vacancy_type != 'Select vacancy type' && $vacancy_type != '') {
            $data->Where('post_jobs.vacancy_type', '=', $vacancy_type);
        }
        $data = $data->orderBy('post_jobs.start_date', 'DESC')
            ->paginate(10);

        // dd($vacancy_type);

        return view('Cms.search', compact('data', 'search', 'topMenu', 'mainMenu', 'bottomMenu', 'menuFooterItems', 'slugLanguage', 'countDate'));
    }
}
