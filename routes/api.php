<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Controllers\IndicatorController;
use App\Controllers\MatrikController;
use App\Controllers\sdgController;



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

Route::get('/projects', 'ProjectsController@getAllProjects');
Route::get('/projects/{id}', 'ProjectsController@getProject');

