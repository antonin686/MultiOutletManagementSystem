<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/


Route::get('/home', 'admin\AdminController@index')->name('admin.index');
Route::get('/profile', 'admin\AdminController@show')->name('admin.profile');
Route::post('/profile', 'admin\AdminController@update');

Route::get('/tables', 'admin\AdminController@table')->name('admin.tables');

Route::get('/ajax/getValues', 'admin\AjaxController@show');

Route::get('/employee/show/{id}', 'admin\EmployeeController@show')->name('employee.show');
Route::post('/employee/show/{id}', 'admin\EmployeeController@update');



Route::get('/employee/create', 'admin\EmployeeController@create')->name('employee.create');
Route::post('/employee/create', 'admin\EmployeeController@store');