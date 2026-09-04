<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MapController;


/*
|--------------------------------------------------------------------------
| PUBLIC HOME PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| PUBLIC VIEW-ONLY PAGES
|--------------------------------------------------------------------------
| These pages can be accessed by anyone, even without logging in.
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| PROJECTS
|--------------------------------------------------------------------------
*/

Route::get('/projects', [ProjectController::class, 'index'])
    ->name('projects.index');


/*
|--------------------------------------------------------------------------
| PROJECT MAP
|--------------------------------------------------------------------------
*/

Route::get('/project-map', [MapController::class, 'index'])
    ->name('projects.map');


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');


/*
|--------------------------------------------------------------------------
| REPORTS
|--------------------------------------------------------------------------
*/

Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports.index');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED DASHBOARD REDIRECT
|--------------------------------------------------------------------------
| /dashboard still requires login.
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
| These functions require the user to be logged in.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | PROJECT MANAGEMENT / CRUD
    |--------------------------------------------------------------------------
    | index is excluded because the public version is above.
    |--------------------------------------------------------------------------
    */

    Route::resource('projects', ProjectController::class)
        ->except(['index', 'show']);


    /*
    |--------------------------------------------------------------------------
    | PROJECT PDF
    |--------------------------------------------------------------------------
    */

    Route::get('/projects/{project}/pdf', [ProjectController::class, 'generatePdf'])
        ->name('projects.pdf');


    /*
    |--------------------------------------------------------------------------
    | SURVEY FORMS
    |--------------------------------------------------------------------------
    */

    Route::get('/survey-forms', [SurveyController::class, 'index'])
        ->name('survey.index');

    Route::post('/survey-forms', [SurveyController::class, 'store'])
        ->name('survey.store');


    /*
    |--------------------------------------------------------------------------
    | CONSOLIDATED REPORT PDF
    |--------------------------------------------------------------------------
    */

    Route::get('/reports/projects-pdf', [ReportController::class, 'projectsPdf'])
        ->name('reports.projects-pdf');


    /*
    |--------------------------------------------------------------------------
    | USER PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';