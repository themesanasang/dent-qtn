<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

define('error_login', 'ชื่อผู้ใช้งานหรือรหัสผ่าน ผิด!! กรุณาลองใหม่อีกครั้ง');
define('save_data', 'บันทึกข้อมูลเรียบร้อยแล้ว');
define('error_save_data', 'ไม่สามารถบันทึกข้อมูลได้');





Route::get('/', 'ScreenController@index');
Route::resource('screen', 'ScreenController');
Route::get('screen.list', 'ScreenController@screenlist');
Route::post('screen.search', 'ScreenController@search');
Route::get('getAmphur/{id}', 'ScreenController@getAmphur');
Route::get('getDistrict/{id}/{id2}', 'ScreenController@getDistrict');
Route::get('screen/getAmphur/{id}', 'ScreenController@getAmphur');
Route::get('screen/getDistrict/{id}/{id2}', 'ScreenController@getDistrict');






Route::resource('login', 'LoginController');
Route::get('logout', 'LoginController@logout');






Route::resource('user', 'UserController');
Route::get('user/editprofile/{id}', 'UserController@editprofile');
Route::get('user/getAmphur/{id}', 'ScreenController@getAmphur');
Route::get('user/getDistrict/{id}/{id2}', 'ScreenController@getDistrict');





Route::resource('screen', 'ScreenController');






Route::resource('report', 'ReportController');
