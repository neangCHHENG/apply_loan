<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Helper\RBAC;
use App\Helper\VisitorHelper;
use App\Models\Article;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardBackendController extends Controller
{

    public function DashboardBackend()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }
        $visitor    = self::mapVisitor();
        $article    = self::mapArticle();


        return [
            'visitor' => $visitor,
            'article' => $article

        ];
    }

    static function mapVisitor()
    {
        // $currentDate = self::currentDate();
        // $day    = Visitor::where('state', 1)->whereDay('created_at', $currentDate['currentDay'])->count();
        // $month  = Visitor::where('state', 1)->whereMonth('created_at', $currentDate['currentMonth'])->count();
        // $year   = Visitor::where('state', 1)->whereYear('created_at', $currentDate['currentYear'])->count();
        $all    = Visitor::where('state', 1)->count();

        // $visitors  = Visitor::orderBy('created_at')->get();
        // $chart = array();
        // foreach ($visitors as $v) {
        //     $lable = ($v->created_at)->format('M Y');
        //     $chart[$lable] = Visitor::where('state', 1)->whereMonth('created_at', $v->created_at)->count();
        // }

        return [
            // 'data'  => $visitors,
            // 'day'   => $day,
            // 'month' => $month,
            // 'year'  => $year,
            // 'chart' => $chart,
            'all'   => $all
        ];
    }
    static function mapArticle()
    {
        // $currentDate = self::currentDate();
        // $day    = Article::where('state', 1)->whereDay('created_at', $currentDate['currentDay'])->count();
        // $month  = Article::where('state', 1)->whereMonth('created_at', $currentDate['currentMonth'])->count();
        // $year   = Article::where('state', 1)->whereYear('created_at', $currentDate['currentYear'])->count();
        $all    = Article::where('state', 1)->count();

        // $article  = Article::orderBy('created_at')->get();
        // $chart = array();
        // foreach ($article as $v) {
        //     $lable = ($v->created_at)->format('M Y');
        //     $chart[$lable] = Article::where('state', 1)->whereMonth('created_at', $v->created_at)->count();
        // }

        return [
            // 'data' => $article,
            // 'day' => $day,
            // 'month' => $month,
            // 'year' => $year,
            // 'chart' => $chart,
            'all' => $all
        ];
    }
    static function currentDate()
    {
        $currentDate = Carbon::now();
        $currentDay =  $currentDate->format('d');
        $currentMonth =  $currentDate->format('m');
        $currentYear =  $currentDate->format('Y');

        return [
            'currentDate' =>  $currentDate,
            'currentDay' =>  $currentDay,
            'currentMonth' =>  $currentMonth,
            'currentYear' =>  $currentYear,
        ];
    }
}
