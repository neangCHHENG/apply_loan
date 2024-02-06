<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactSubmitController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\googleCalendarController;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use App\Http\Controllers\ApplyLoanController;


//=======================================================================
//  Star Fornt-end English Content
//=======================================================================

Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

//testing mail
Route::get('sendEmail', [EmailController::class, 'sendEmail']);


// Testing Google Calendar

Route::get('google-view', function () {
    return view('googleCalendar');
});
Route::post('google-event', function (Request $request) {

    $data = Event::get();
    return response()->json($data);
})->name('google.event');


Route::get('google-calendar', [googleCalendarController::class, 'index']);
Route::post('google-calendar/action', [googleCalendarController::class, 'action']);

// Testing Google Calendar

// @include('routeFrontEnd.php');

// Admin

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::get('/admin/home', [HomeController::class, 'index']);

    Route::group(['prefix' => 'filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    //google auth//
    Route::get('/redirect', [AuthController::class, 'redirect']);
    Route::get('/login/google/callback', [AuthController::class, 'callback']);
    //google auth//

    #region Admin
    //Route::get('/admin/index', [AdminController::class, 'index']);
    Route::get('/admin/viewUser', [AdminController::class, 'viewUser']);
    Route::get('/admin/viewPermission', [AdminController::class, 'viewPermission',]);
    Route::get('/admin/viewroles', [AdminController::class, 'viewroles']);
    Route::post('/admin/viewUserPhoto', [AdminController::class, 'viewUserPhoto',]);
    #endregion

    Route::post('/admin/saveUser/saveUserFontEnd', [AdminController::class, 'saveUserFontEnd']);

    Route::post('/admin/apply-loan/applyLoanSubmit', [ApplyLoanController::class, 'applyLoanSubmit']);
});

Route::get('search', [SearchController::class, 'search'])->name('search');
Route::get('en/search', [SearchController::class, 'searchEn'])->name('searchEn');
Route::get('/{slug}', [PageController::class, 'render'])->where('slug', '.*')->middleware('visitor');
