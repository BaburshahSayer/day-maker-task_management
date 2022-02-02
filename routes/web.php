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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    //projects related routes 
    Route::resource('projects','ProjectController')->only(['index', 'store']);;
    //tasks routes
    Route::resource('tasks','TaskController')->except(['create', 'show']);
    //task status update route
    Route::post('task_status','TaskController@TaskStatus')->name('task_status');
    //setup task order route
    Route::post('task_order','TaskController@TaskOrder')->name('task_order');
});
