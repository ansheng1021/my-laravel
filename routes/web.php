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
Route::get('/user/index', 'testController@index');
Route::get('/user/poerty', 'poertyAuthorController@poerty');
Route::get("/user/storage/{file_name}","FileController@browse");
Route::post("/baidu/queryCarNumber","Api\UserController@queryCarNumber");
//Route::get('/poerty/author/{id}','aboutPoerty\AuthorList@getAuthorList');
Route::get('/poerty/author','aboutPoerty\AuthorList@getAuthorList');
Route::get('/poerty/getRandomPoerty','aboutPoerty\AuthorList@getRandomPoerty');

Route::get('/upload','Api\UserController@display');
