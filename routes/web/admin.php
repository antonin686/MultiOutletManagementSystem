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

Route::get('/home', function () {
    return view('admin.home');
})->name('admin.home');

Route::get('/empList', 'admin\empController@getList');
Route::get('/ajax/getValues', 'admin\AjaxController@show');

Route::get('/profile', [
    'as' => 'employee.getByID',
    'uses' => 'admin\empController@getProfile',
]);


