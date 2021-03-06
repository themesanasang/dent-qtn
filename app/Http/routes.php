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
Route::get('screen/image/delete/{id}/{id2}', 'ScreenController@deleteImage');




Route::resource('login', 'LoginController');
Route::get('logout', 'LoginController@logout');





Route::resource('user', 'UserController');
Route::get('user/editprofile/{id}', 'UserController@editprofile');
Route::get('user/getAmphur/{id}', 'ScreenController@getAmphur');
Route::get('user/getDistrict/{id}/{id2}', 'ScreenController@getDistrict');



Route::get('downloads/{path}/{namefile}', 'DownloadController@index');
Route::get('downloads/app', 'DownloadController@loadApp');
Route::get('downloads/{path}/{namefile}/{screenid}/{fileid}', 'DownloadController@deleteFile');
Route::resource('screen', 'ScreenController');





Route::resource('patient', 'PatientController');
Route::get('patient/treatment/{id}', 'PatientController@treatment');
Route::get('patient/listscreen/{cid}/{id}', 'PatientController@listscreen');





Route::resource('treatment', 'TreatmentController');
Route::get('treatment/create/{id}', 'TreatmentController@create');




//Route::get('report/pmd', 'ReportController@report_pmd');
Route::get('reports/export_pmd', 'ReportController@export_pmd');
Route::resource('reports', 'ReportController');




