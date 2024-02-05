<?php

namespace App\Helper;

use App\Models\Info;

class MenuFrontendHelper
{
    public static function menuFrontend()
    {
        $topMenu = MenuHelper::all_menu_by_type('Top');
        $mainMenu = MenuHelper::all_menu_by_type('Main');
        $bottomMenu = MenuHelper::all_menu_by_type('Bottom');
        $menuFooterItems = Info::where('state', 1)->get();
        return [
            'topMenu' => $topMenu,
            'mainMenu' => $mainMenu,
            'bottomMenu' => $bottomMenu,
            'menuFooterItems' => $menuFooterItems
        ];
    }
}
