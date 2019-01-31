<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('news', 'NewsController@index');
    Route::post('news', 'NewsController@save')->name('save_news');
    Route::get('news/create', 'NewsController@create');
    Route::get('news/{news}', 'NewsController@show');
    Route::delete('news/{news}', 'NewsController@delete');
    Route::post('news/{news}', 'NewsController@update');
    Route::get('news/{news}/edit', 'NewsController@edit');

    Route::get('import', 'UserController@showImport');
    Route::post('users/import', 'UserController@import');
});
