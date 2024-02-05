<?php

namespace App\Helper;

use App\Models\Article;
use App\Models\Benefit;
use App\Models\CategoryArticle;
use App\Models\Company;
use App\Models\Department;
use App\Models\Slide;
use App\Models\Info;
use App\Models\LanguageSkill;
use App\Models\PopupHome;
use App\Models\PostJob;
use Illuminate\Support\Facades\DB;

class ViewHelper
{
    public static function get_view_by_type($menu_type, $reference_id = null)
    {
        switch ($menu_type) {

            case ('single_article'):
                $data = Article::where('state', 1)->where('id', $reference_id)->first();
                if ($data == null) { // page not found
                    return [
                        'data' => null,
                        'view' => 'Cms.page-error',
                    ];
                }
                return [
                    'data' => $data,
                    'view' => 'Cms.single-article',
                ];
            case ('feature_article'):
                $data = Article::where('state', 1)->where('schedule', '<=', date('Y-m-d'))->where('feature', 1)->paginate(9);
                if (count($data) == null) { // page not found
                    return [
                        'data' => null,
                        'view' => 'Cms.page-error',
                    ];
                }
                return [
                    'data' => $data,
                    'view' => 'Cms.feature-article',
                ];
            case ('single_category'):
                $category = CategoryArticle::find($reference_id);
                $article = Article::where('state', 1)->where('parent_category_id', $reference_id)->orderBy('created_at', 'DESC')->paginate(9);
                if ($reference_id == 8) {
                    $article = Article::where('state', 1)->where('parent_category_id', $reference_id)->orderBy('ordering', 'ASC')->paginate(9);
                }
                if ($reference_id == 3) {
                    $article = Article::where('state', 1)->where('parent_category_id', $reference_id)->where('schedule', '<=', now())->orderBy('schedule', 'DESC')->paginate(9);
                }
                if (count($article) == null) { // page not found
                    return [
                        'data' => null,
                        'view' => 'Cms.page-error',
                    ];
                }
                return [
                    'data' => ['category' => $category, 'article' => $article],
                    'view' => 'Cms.single-category',
                ];
            case ('category_list'):
                $data = CategoryArticle::where('state', 1)->paginate(9);
                if (count($data) == null) { // page not found
                    return [
                        'data' => null,
                        'view' => 'Cms.page-error',
                    ];
                }
                return [
                    'data' => $data,
                    'view' => 'Cms.category-list',
                ];
            case ('article-list'): // list by id category article
                $data = Article::where('state', 1)->where('schedule', '<=', date('Y-m-d'))->where('parent_category_id', $reference_id)->paginate(9);
                if (count($data) == null) { // page not found
                    return [
                        'data' => null,
                        'view' => 'Cms.page-error',
                    ];
                }
                return [
                    'data' =>  $data,
                    'view' => 'Cms.article-list',
                ];
            case ('contact_form'):
                $data = Info::where('state', 1)->get();
                $mapData = self::mapDatapageContact($data);
                return [
                    'data' => $mapData,
                    'view' => 'Cms.contact-form',
                ];
            case ('company_list'):
                $slide = Slide::where('state', 1)->get();
                $companyList = Company::join('departments as d', 'companies.department', '=', 'd.id')
                    ->leftJoin('post_jobs as pj', 'pj.company', '=', 'companies.id')
                    ->select(
                        'companies.id',
                        'companies.title_en',
                        'companies.title_kh',
                        'companies.external_url',
                        'companies.thumbnail',
                        'd.title_en as department_en',
                        'd.title_kh as department_kh',
                        DB::raw('COUNT(pj.id) as job_count')
                    )
                    ->orderBy('companies.title_en', 'ASC')
                    ->where('companies.state', '!=', 0)
                    ->groupBy(
                        'companies.id',
                        'companies.title_en',
                        'companies.title_kh',
                        'companies.external_url',
                        'companies.thumbnail',
                        'd.title_en',
                        'd.title_kh'
                    )
                    ->paginate(10);

                return [
                    'data' => ['slide' => $slide, 'companyList' => $companyList],
                    'view' => 'Cms.company-list',
                ];
            case ('job_list'):
                $currentDate = now()->format('Y-m-d');
                $slide = Slide::where('state', 1)->get();
                $jobList = PostJob::join('positions', 'post_jobs.position', '=', 'positions.id')
                    ->join('locations', 'post_jobs.location', '=', 'locations.id')
                    ->join('vacancy_types', 'post_jobs.vacancy_type', '=', 'vacancy_types.id')
                    ->join('qualifications', 'post_jobs.qualification', '=', 'qualifications.id')
                    ->join('companies', 'post_jobs.company', '=', 'companies.id')
                    ->leftjoin('departments', 'positions.department', '=', 'departments.id')
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
                    ->where('post_jobs.state', '!=', 0)
                    ->where('post_jobs.start_date', '<=', $currentDate)
                    ->where('post_jobs.end_date', '>=', $currentDate)
                    ->orderBy('post_jobs.start_date', 'DESC')
                    ->paginate(10);

                return [
                    'data' => ['slide' => $slide, 'jobList' => $jobList],
                    'view' => 'Cms.job-list',
                ];
            case ('employer'): // page job by company
                $currentDate = now()->format('Y-m-d');
                $post = PostJob::where('company', $reference_id)->first();
                $detail_job = PostJob::join('positions', 'post_jobs.position', '=', 'positions.id')
                    ->join('locations', 'post_jobs.location', '=', 'locations.id')
                    ->join('vacancy_types', 'post_jobs.vacancy_type', '=', 'vacancy_types.id')
                    ->join('qualifications', 'post_jobs.qualification', '=', 'qualifications.id')
                    ->join('companies', 'post_jobs.company', '=', 'companies.id')
                    ->join('language_skills', 'post_jobs.language_skills', '=', 'language_skills.id')
                    ->join('career_levels', 'post_jobs.career_level', '=', 'career_levels.id')
                    ->leftjoin('departments', 'positions.department', '=', 'departments.id')
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
                        'post_jobs.company',
                        'qualifications.title_en as qualification_en',
                        'qualifications.title_kh as qualification_kh',
                        'post_jobs.language_skills',
                        'companies.title_en as company_en',
                        'companies.title_kh as company_kh',
                        'companies.thumbnail as thumbnail_com',
                        'companies.facebook_url',
                        'companies.external_url',
                        'companies.note',
                        'language_skills.title_en as language_skills_en',
                        'language_skills.title_kh as language_skills_kh',
                        'career_levels.title_en as career_level_en',
                        'career_levels.title_kh as career_level_kh',
                    )
                    ->where('post_jobs.id', '=', $reference_id)->first();


                if (!$post) {
                    $data = Company::join('departments as deps', 'companies.department', '=', 'deps.id')
                        ->select(
                            'companies.title_en as company_en',
                            'companies.title_kh as company_kh',
                            'companies.thumbnail as thumbnail_com',
                            'companies.facebook_url',
                            'companies.description_en',
                            'companies.description_kh',
                            'companies.note',
                            'companies.external_url',
                            'deps.title_en as deps_en',
                            'deps.title_kh as deps_kh',
                        )
                        ->where('companies.state', '!=', 0)
                        ->paginate(10);
                } else {
                    $data = PostJob::join('positions', 'post_jobs.position', '=', 'positions.id')
                        ->join('locations', 'post_jobs.location', '=', 'locations.id')
                        ->join('vacancy_types', 'post_jobs.vacancy_type', '=', 'vacancy_types.id')
                        ->join('qualifications', 'post_jobs.qualification', '=', 'qualifications.id')
                        ->leftjoin('companies', 'post_jobs.company', '=', 'companies.id')
                        ->rightJoin('departments as deps', 'companies.department', '=', 'deps.id') // Corrected line
                        ->select(
                            'post_jobs.id',
                            'positions.title_en as position_en',
                            'positions.title_kh as position_kh',
                            'vacancy_types.title_en as vacancy_en',
                            'vacancy_types.title_kh as vacancy_kh',
                            'post_jobs.start_date',
                            'post_jobs.thumbnail',
                            'post_jobs.offered_salary',
                            'post_jobs.urgent',
                            'companies.title_en as company_en',
                            'companies.title_kh as company_kh',
                            'companies.thumbnail as thumbnail_com',
                            'companies.facebook_url',
                            'companies.description_en',
                            'companies.description_kh',
                            'companies.note',
                            'companies.external_url',
                            'deps.title_en as deps_en',
                            'deps.title_kh as deps_kh',
                            'locations.title_en as locations_en',
                            'locations.title_kh as locations_kh',
                        )
                        ->where('post_jobs.state', '!=', 0)
                        ->where('post_jobs.start_date', '<=', $currentDate)
                        ->where('post_jobs.end_date', '>=', $currentDate)
                        ->where('post_jobs.company', '=', $reference_id)
                        ->orderBy('post_jobs.start_date', 'DESC')
                        ->paginate(10);
                }
                if ($data == null) { // page not found
                    return [
                        'data' => null,
                        'view' => 'Cms.page-error',
                    ];
                }
                return [
                    'data' =>  ['data' => $data, 'detail_job' => $detail_job],
                    'view' => 'Cms.find-job-company',
                ];
            case ('articles'): // page detail articles
                $currentDate = now()->format('Y-m-d');
                $related_job = PostJob::join('positions', 'post_jobs.position', '=', 'positions.id')
                    ->join('vacancy_types', 'post_jobs.vacancy_type', '=', 'vacancy_types.id')
                    ->select(
                        'positions.title_en',
                        'positions.title_kh',
                        'post_jobs.id',
                        'post_jobs.company',
                        'post_jobs.start_date',
                        'vacancy_types.title_en as vacancy_type_en',
                        'vacancy_types.title_en as vacancy_type_kh',
                    )
                    ->where('post_jobs.state', '!=', 0)
                    ->where('post_jobs.start_date', '<=', $currentDate)
                    ->where('post_jobs.end_date', '>=', $currentDate)
                    ->orderBy('post_jobs.start_date', 'DESC')
                    ->paginate(10);
                $detail_job = PostJob::join('positions', 'post_jobs.position', '=', 'positions.id')
                    ->join('locations', 'post_jobs.location', '=', 'locations.id')
                    ->join('vacancy_types', 'post_jobs.vacancy_type', '=', 'vacancy_types.id')
                    ->join('qualifications', 'post_jobs.qualification', '=', 'qualifications.id')
                    ->join('companies', 'post_jobs.company', '=', 'companies.id')
                    ->join('language_skills', 'post_jobs.language_skills', '=', 'language_skills.id')
                    ->join('career_levels', 'post_jobs.career_level', '=', 'career_levels.id')
                    ->leftjoin('departments', 'positions.department', '=', 'departments.id')
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
                        'post_jobs.company',
                        'qualifications.title_en as qualification_en',
                        'qualifications.title_kh as qualification_kh',
                        'post_jobs.language_skills',
                        'companies.title_en as company_en',
                        'companies.title_kh as company_kh',
                        'companies.thumbnail as thumbnail_com',
                        'companies.facebook_url',
                        'companies.external_url',
                        'companies.note',
                        'language_skills.title_en as language_skills_en',
                        'language_skills.title_kh as language_skills_kh',
                        'career_levels.title_en as career_level_en',
                        'career_levels.title_kh as career_level_kh',
                    )
                    ->where('post_jobs.id', '=', $reference_id)->first();

                $post = PostJob::where('id', $reference_id)->first();
                $languageSkillIds = explode(',', $post['language_skills']);
                $languageSkill = LanguageSkill::whereIn('id', $languageSkillIds)->get();

                if ($detail_job == null) { // page not found
                    return [
                        'data' => null,
                        'view' => 'Cms.page-error',
                    ];
                }
                return [
                    'data' =>  ['languageSkill' => $languageSkill, 'related_job' => $related_job, 'detail_job' => $detail_job],
                    'view' => 'Cms.detail-job-post',
                ];

            case ('main_page'):
                $currentDate = now()->format('Y-m-d');
                $slide = Slide::where('state', 1)->get();
                $benefit = Benefit::where('state', 1)->get();
                $jobList = PostJob::join('positions', 'post_jobs.position', '=', 'positions.id')
                    ->join('locations', 'post_jobs.location', '=', 'locations.id')
                    ->join('vacancy_types', 'post_jobs.vacancy_type', '=', 'vacancy_types.id')
                    ->join('qualifications', 'post_jobs.qualification', '=', 'qualifications.id')
                    ->join('companies', 'post_jobs.company', '=', 'companies.id')
                    ->leftjoin('departments', 'positions.department', '=', 'departments.id')
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
                    ->where('post_jobs.state', '!=', 0)
                    ->where('post_jobs.start_date', '<=', $currentDate)
                    ->where('post_jobs.end_date', '>=', $currentDate)
                    ->orderBy('post_jobs.start_date', 'DESC')
                    ->take(10)
                    ->get();

                $department = Department::leftJoin('positions', 'departments.id', '=', 'positions.department')
                    ->leftJoin('post_jobs', function ($join) use ($currentDate) {
                        $join->on('positions.id', '=', 'post_jobs.position')
                            ->where('post_jobs.state', '!=', 0)
                            ->orWhereNull('post_jobs.state')
                            ->where('post_jobs.start_date', '<=', $currentDate)
                            ->where('post_jobs.end_date', '>=', $currentDate);
                    })
                    ->select(
                        'departments.id',
                        'departments.title_en',
                        'departments.title_kh',
                        'departments.thumbnail',
                        DB::raw('count(post_jobs.id) as job_count')
                    )
                    ->groupBy('departments.id', 'departments.title_en', 'departments.title_kh', 'departments.thumbnail')
                    ->get();
                return [
                    'data' => ['department' => $department, 'benefit' => $benefit, 'jobList' => $jobList, 'slide' => $slide],
                    'view' => 'Cms.home',
                ];
            default:
                return 'Cms.default';
        }
    }

    public static function mapDatapageContact($data)
    {
        $latitude = $data->filter(function ($value, $key) {
            return $value->key == 'latitude';
        });
        $longitude = $data->filter(function ($value, $key) {
            return $value->key == 'longitude';
        });
        $titleMap = $data->filter(function ($value, $key) {
            return $value->key == 'title-tap';
        });
        $contentMap = $data->filter(function ($value, $key) {
            return $value->key == 'content-map';
        });
        $phone = $data->filter(function ($value, $key) {
            return $value->type == 'phone';
        });
        $email = $data->filter(function ($value, $key) {
            return $value->type == 'email';
        });
        $socailMedia = $data->filter(function ($value, $key) {
            return $value->type == 'socailMedia';
        });
        $website = $data->filter(function ($value, $key) {
            return $value->type == 'website';
        });
        return [
            'latitude' => $latitude->first(),
            'longitude' => $longitude->first(),
            'titleMap' => $titleMap->first(),
            'contentMap' => $contentMap->first(),
            'phone' => $phone,
            'email' => $email,
            'socailMedia' => $socailMedia,
            'website' => $website,
        ];
    }
}
