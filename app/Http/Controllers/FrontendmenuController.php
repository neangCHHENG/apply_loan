<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\Type;


class FrontendmenuController extends Controller
{
    protected function getTopMenu()
    {
        $menuItems = Menu::where('is_root',0)->where('type', 'Top')->get(); 
         return view ('FrontEnd.components.topmenu',compact('menuItems'));
    }
}
