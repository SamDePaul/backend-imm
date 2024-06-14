<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Controllers\IndicatorController;
use App\Controllers\MatrikController;
use App\Controllers\sdgController;
use App\Controllers\immProfileController;
use App\Controllers\TagController;
use App\Controllers\CompanyController;
use App\Controllers\ProjectsController;
use App\Controllers\UserController;
use App\Controllers\BlogController;
use App\Controllers\CommentController;
use App\Controllers\FrontendAuthController;
use App\Controllers\FrontendRegisterController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/users', function (Request $request) {
    return $request->user();
});

Route::post('login', 'FrontendAuthController@login');
Route::post('register', 'FrontendRegisterController@register');

Route::get('/matrik', 'MatrikController@getMatrik')->name('matrik');
Route::get('/indicator', 'IndicatorController@getIndicators')->name('sdg');
Route::get('/sdg', 'sdgController@getSdg')->name('sdg');
Route::get('/tag', 'TagController@getTag')->name('tag');


Route::get('/company', 'CompanyController@getCompany')->name('company');
Route::post('/company', 'CompanyController@createCompany')->name('addcompany');
Route::get('/company/{company_id}', 'CompanyController@getCompanyById')->name('getCompanyByID');
Route::get('/company-user/{user_id}', 'CompanyController@getCompanyByIdUser')->name('getCompanyByIDUser');



Route::get('/user', 'UserController@getUser')->name('getUser');
Route::get('/user/{email}', 'UserController@getUserByEmail')->name('getUserByEmail');
Route::get('/user-id/{user_id}', 'UserController@getUserById')->name('getUserByID');

Route::post('/add-project', 'ProjectsController@createProject');
Route::get('/projects', 'ProjectsController@getAllProjects');
Route::get('/projects/{id}', 'ProjectsController@getProject');
Route::put('/update-projects/{id}', 'ProjectsController@updateProject');

Route::post('/otp', 'ImmProfileController@GetloginOtp');
Route::post('/otp-verification', 'ImmProfileController@VerifyOtp');

Route::get('blogs', 'BlogController@getAll');
Route::get('blogs/{id}', 'BlogController@getById');

Route::get('blogs/{blog}/comments', 'CommentController@getallComments');
Route::get('comments/{id}', 'CommentController@getComment');
Route::get('users/{id}/comments', 'CommentController@getUserComment');
Route::post('blogs/{blog}/comments', 'CommentController@createComment');
Route::put('comments/{comment}', 'CommentController@editComment');
Route::delete('comments/{comment}', 'CommentController@deleteF');


Route::get('/get-regions/{country_id}', 'ProvinceController@getRegions');
Route::get('/get-cities/{region_id}', 'ProvinceController@getCities');
Route::get('/get-countries', 'ProvinceController@getCountries');

Route::get('/get-sdg', 'sdgController@getSdg');
Route::get('/get-indicators/{sdg_id}', 'sdgController@getIndicatorsByIdSdg');
Route::get('/get-metrics/{indicator_id}', 'sdgController@getMatriksByIndicator');

Route::get('/get-tagId/{tag_id}', 'sdgController@getTagById');
Route::get('/get-sdgId/{sdg_id}', 'sdgController@getSdgById');
Route::get('/get-indicatorId/{indicator_id}', 'sdgController@getIndicatorsById');
Route::get('/get-matricId/{matric_id}', 'sdgController@getMatricById');

Route::get('/get-regionId/{region_id}', 'ProvinceController@getRegionById');
Route::get('/get-cityId/{city_id}', 'ProvinceController@getCityById');
Route::get('/get-countryId/{country_id}', 'ProvinceController@getCountryById');
