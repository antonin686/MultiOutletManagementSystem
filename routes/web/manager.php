<?php

Route::get('/home', function () {
    //Session::put('id','bitch pls');
   // Session::flush();
    return view('manager.home')->with("title","Manager Dashboard");
    //echo 'session("id)';
});

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

Route::get('/outlet/info','manager\ManagerController@outlet_info')->name('outletInfo');

Route::get('/booking','manager\DesignController@booking')->name('booking');
Route::post('/booking','manager\DesignController@insert_booking')->name('insertBooking');



