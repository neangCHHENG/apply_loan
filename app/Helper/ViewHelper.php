<?php

namespace App\Helper;

use App\Models\Article;
use App\Models\Slide;
use App\Models\CategoryArticle;

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

            case ('article-list'): // list by id category article

            case ('contact_form'):

            case ('articles'): // page detail articles

            case ('main_page'):
                $slide = Slide::where('state', 1)->get();
                return [
                    'data' => ['slide' => $slide],
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
