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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

$background = config('managesetting.background','admin');
Route::group(['prefix'=>$background,'namespace'=>'Admin','middleware'=>['auth']],function(){
	Route::get('/','AdminController@index');
	Route::get('/test',function(){
		echo 'nice';
	});
	Route::resource('category','CategoryController');
});