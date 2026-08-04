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
| Public Home Page
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Projects (CRUD)
    |--------------------------------------------------------------------------
    */
    Route::resource('projects', ProjectController::class)
        ->except(['show']);

    /*
    |--------------------------------------------------------------------------
    | Project Map
    |--------------------------------------------------------------------------
    */
    Route::get('/project-map', [MapController::class, 'index'])
        ->name('projects.map');

    /*
    |--------------------------------------------------------------------------
    | Project PDF Reports
    |--------------------------------------------------------------------------
    */
    Route::get('/projects/{project}/pdf', [ProjectController::class, 'generatePdf'])
        ->name('projects.pdf');

    /*
    |--------------------------------------------------------------------------
    | Survey Forms
    |--------------------------------------------------------------------------
    */
    Route::get('/survey-forms', [SurveyController::class, 'index'])
        ->name('survey.index');

    Route::post('/survey-forms', [SurveyController::class, 'store'])
        ->name('survey.store');

    /*
    |--------------------------------------------------------------------------
    | Consolidated Reports
    |--------------------------------------------------------------------------
    */
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    Route::get('/reports/projects-pdf', [ReportController::class, 'projectsPdf'])
        ->name('reports.projects-pdf');

    /*
    |--------------------------------------------------------------------------
    | User Profile
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
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';