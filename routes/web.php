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

Route::get('/mailVerification', function () {
    return view('mailVerification');
})->name('mailVerification');


Route::resource('blogs', 'BlogController');


Route::get('blogs/{blog}/comments', 'CommentController@index')->name('comments.index');
Route::get('blogs/{blog}/comments', 'CommentController@index')->name('comments.index');
Route::post('blogs/{blog}/comments','CommentController@store')->name('comments.store');
Route::delete('comments/{comment}','CommentController@destroy')->name('comments.destroy');








