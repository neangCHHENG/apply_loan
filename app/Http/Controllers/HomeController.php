<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    //
    public function index()
    {
        if (session()->has('AuthToken') == false) {
            return redirect('login');
        }

        return View('Home.index');
    }

    public function getFristNewsCarousel(){
        $news = CategoryArticle::where('state', 1)->where('slug', 'news')->first();
        $news_arclile = Article::where('state', 1)->where('parent_category_id', $news->id)->where('schedule', '<=', date('Y-m-d'))->orderBy('id', 'DESC')->paginate(8);
        return $news_arclile;
    }

    public function newsArticleHome(){
        $news = CategoryArticle::where('state', 1)->where('slug', 'news')->first();
        $news_arclile = Article::where('state', 1)->where('parent_category_id', $news->id)->where('schedule', '<=', date('Y-m-d'))->orderBy('id', 'DESC')->paginate(8);    
        return $news_arclile;
    }

    // public function dashboard()
    // {
    //     if (session()->has('AuthToken') == false) {
    //         return redirect('login');
    //     }

    //     return View('Home.dashboard');
    // }
}
