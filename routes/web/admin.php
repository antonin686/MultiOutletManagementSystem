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
    
Route::group(['middleware' => 'checkIfAdmin'], function()
{

    Route::get('/home', 'admin\AdminController@index')->name('admin.index');
    Route::get('/profile', 'admin\AdminController@show')->name('admin.profile');
    Route::get('/changepassword', 'admin\AdminController@password')->name('admin.change_password');
    Route::post('/changepassword', 'admin\AdminController@changePassword');
    Route::get('/logout', 'admin\AdminController@logout')->name('admin.logout');
    Route::post('/profile', 'admin\AdminController@update');

    Route::get('/tables', 'admin\AdminController@table')->name('admin.tables');

    Route::get('/attendence', 'admin\AdminController@attendence')->name('admin.attendence');

    //ajax
    Route::get('/ajax/getAttendence', 'admin\AjaxController@getAttendence');
    Route::get('/ajax/getRevenue', 'admin\AjaxController@getRevenue');
    Route::get('/ajax/getOutletCount', 'admin\AjaxController@getOutletCount');
    Route::get('/ajax/getBookingCount', 'admin\AjaxController@getBookingCount');
    Route::get('/ajax/getWeeklyTransaction', 'admin\AjaxController@getWeeklyTransaction');
    Route::get('/ajax/getDailyTransaction', 'admin\AjaxController@getDailyTransaction');

    //Employee
    Route::get('/employee/index', 'admin\EmployeeController@index')->name('employee.index');
    Route::get('/employee/show/{id}', 'admin\EmployeeController@show')->name('employee.show');
    Route::post('/employee/show/{id}', 'admin\EmployeeController@update');

    Route::get('/employee/create', 'admin\EmployeeController@create')->name('employee.create');
    Route::post('/employee/create', 'admin\EmployeeController@store');

    Route::get('/employee/destroy/{id}', 'admin\EmployeeController@destroy')->name('employee.destroy');

    //Outlet
    Route::get('/outlet/index', 'admin\OutletController@index')->name('outlet.index');

    Route::get('/outlet/show/{id}', 'admin\OutletController@show')->name('outlet.show');
    Route::post('/outlet/show/{id}', 'admin\OutletController@update');

    Route::get('/outlet/create', 'admin\OutletController@create')->name('outlet.create');
    Route::post('/outlet/create', 'admin\OutletController@store');

    Route::get('/outlet/destroy/{id}', 'admin\OutletController@destroy')->name('outlet.destroy');

    //booking
    Route::get('/booking/index', 'admin\BookingController@index')->name('booking.index');

    Route::get('/booking/create', 'admin\BookingController@create')->name('booking.create');
    Route::post('/booking/create', 'admin\BookingController@store');

    //Order
    Route::get('/order/index', 'admin\OrderController@index')->name('order.index');
});