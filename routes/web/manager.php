<?php
Route::get('/home', 'manager\ManagerController@home')->name('manager.home');

Auth::routes();

Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('login');
 });

Route::get('/profile', 'manager\ManagerController@manager_profile')->name('manager.profile');

Route::get('/profile/edit', 'manager\ManagerController@edit_profile')->name('managerProfile.edit');
Route::post('/profile/edit', 'manager\ManagerController@update_profile')->name('managerProfile.update');

Route::get('/settings', 'manager\ManagerController@settings')->name('managerProfile.settings');
Route::post('/settings', 'manager\ManagerController@update_password')->name('managerProfile.password');

Route::get('/addemployee', 'manager\ManagerController@addEmployeePage')->name('addEmployeePage');
Route::post('/addemployee', 'manager\ManagerController@addEmployee')->name('addEmployee');

Route::get('/employeelist', 'manager\ManagerController@employee_list')->name('employeeList');

Route::get('/employeelist/edit','manager\ManagerController@edit_employee')->name('editEmployeePage');
Route::post('/employeelist/edit','manager\ManagerController@update_employee')->name('updateEmployee');

Route::get('/employeelist/info', 'manager\ManagerController@employee_info')->name('employeeInfo');

Route::get('/employeelist/delete/{id}','manager\ManagerController@destroy_employee')->name('destroyEmployee');

Route::get('/inventory/productType','manager\InventoryController@product_type')->name('ProductTypePage');
Route::post('/inventory/productType','manager\InventoryController@insert_type')->name('insertProductType');

Route::get('/inventory/addProduct','manager\InventoryController@add_product')->name('addProductPage');
Route::post('/inventory/addProduct','manager\InventoryController@insert_product')->name('insertProduct');

Route::get('/inventorylist', 'manager\InventoryController@product_list')->name('productList');

Route::get('/productlist/edit','manager\InventoryController@edit_product')->name('editProductPage');
Route::post('/productlist/edit','manager\InventoryController@update_product')->name('updateProduct');

Route::get('/productlist/delete/{id}','manager\InventoryController@destroy_product')->name('destroyProduct');

Route::get('/outlet/design','manager\DesignController@index')->name('designOutlet');
Route::post('/outlet/design','manager\DesignController@insert')->name('insert');

Route::get('/outlet/tables','manager\DesignController@edit_outlet')->name('editOutlet');

Route::get('/outlet/edit','manager\DesignController@change_outlet')->name('changeOutlet');
Route::post('/outlet/edit','manager\DesignController@update_outlet')->name('updateOutlet');

Route::get('/outlet/table/delete/{id}','manager\DesignController@destroy_table')->name('destroyTable');

Route::get('/outlet/info','manager\ManagerController@outlet_info')->name('outletInfo');

Route::get('/booking','manager\DesignController@booking')->name('booking');
Route::post('/booking','manager\DesignController@insert_booking')->name('insertBooking');

Route::get('/bookedSeats','manager\DesignController@booked_seats')->name('bookedSeats');

Route::get('/bookedSeats/delete/{id}','manager\DesignController@destroy_seat')->name('destroySeat');

Route::get('/orders/pending','manager\ManagerController@pending_orders')->name('pendingOrders');

Route::get('/orders/pending/delete/{id}','manager\ManagerController@destroy_pending')->name('destroyPending');

Route::get('/orders/completed','manager\ManagerController@completed_orders')->name('completedOrders');

Route::get('/attendance','manager\ManagerController@attendance')->name('attendance');
Route::post('/attendance','manager\ManagerController@insert_attendance')->name('insertAttendance');

Route::get('/attendance/view','manager\ManagerController@view_attendance')->name('viewAttendance');
Route::post('/attendance/view','manager\ManagerController@load_attendance')->name('loadAttendance');




