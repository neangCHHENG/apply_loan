<?php

namespace App\Helper;

use App\Models\Visitor;
use Carbon\Carbon;

class VisitorHelper
{
    public static function visitor()
    {
        $currentDate  = Carbon::now();
        $currentDay   = $currentDate->format('d');
        $currentMonth = $currentDate->format('m');
        $currentYear  = $currentDate->format('Y');
        $lastDayofMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->subMonth()->endOfMonth();
        if ($currentDay == 1) {
            $yesterday = Visitor::where('state', 1)->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth - 1)
                ->whereDay('created_at', $lastDayofMonth)
                ->count();
        } else {
            $yesterday = Visitor::where('state', 1)->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->whereDay('created_at', $currentDay - 1)
                ->count();
        }

        $day   = Visitor::where('state', 1)->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->whereDay('created_at', $currentDay)
            ->count();

        $month = Visitor::where('state', 1)->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $year  = Visitor::where('state', 1)->whereYear('created_at', $currentYear)
            ->count();

        $all   = Visitor::where('state', 1)->count();

        return [
            'yesterday' => $yesterday,
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'all' => $all
        ];
    }
}
