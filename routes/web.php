<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/auth/login') ;
});
Route::resource('Countries', 'CountriesController');
Route::resource('users', 'UserController');
Route::resource('projects', 'ProjectsController');
Route::resource('sdgs', 'sdgController');
Route::resource('indicators', 'IndicatorController');
Route::resource('tags', 'TagController');
Route::resource('metrics', 'MatrikController');
Route::resource('companies', 'CompanyController');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blog', 'PostController@index')->name('blog');

Route::get('/get-regions/{country_id}', 'ProvinceController@getRegions');
Route::get('/get-cities/{region_id}', 'ProvinceController@getCities');

Route::get('/company/{company_id}', 'CompanyController@getCompanyById')->name('getCompanyByID');

Route::get('/get-indicator/{sdg_id}', 'sdgController@getIndicators');
Route::get('/get-metric/{tag_id}', 'sdgController@getMatriks');
Route::get('/get-metric-by-indicator/{indicator_id}', 'sdgController@getMatriksByIndicator');

Route::get('/mailVerification', function () {
    return view('mailVerification');
})->name('mailVerification');

//blog
Route::resource('blogs', 'BlogController');
Route::get('blogs/{blog}/comments', 'CommentController@index')->name('comments.index');
Route::get('blogs/{blog}/comments', 'CommentController@index')->name('comments.index');
Route::post('blogs/{blog}/comments','CommentController@store')->name('comments.store');
Route::delete('comments/{comment}','CommentController@destroy')->name('comments.destroy');

//Surveys
Route::resource('surveys', SurveyController::class);
Route::resource('surveys.questions', QuestionController::class)->except(['index', 'show']);
Route::post('surveys/{survey}/responses', [ResponseController::class, 'store'])->name('responses.store');

//Project Report
Route::resource('project_reports', ProjectReportController::class);
Route::get('project_reports/chart/{project}', [ProjectReportController::class, 'showChart'])->name('project_reports.chart');








