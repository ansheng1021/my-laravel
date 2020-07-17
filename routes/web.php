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
Route::get("/user/getAll", "Api\UserController@queryAllUser");
Route::get("/user/store", "Api\UserController@store");
Route::get("/user/update", "Api\UserController@update");
Route::get("/user/delete", "Api\UserController@destory");
