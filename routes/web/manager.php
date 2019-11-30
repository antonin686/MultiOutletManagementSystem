<?php

Route::get('/home', function () {
    //Session::put('id','bitch pls');
   // Session::flush();
    return view('manager.home')->with("title","Manager Dashboard");
    echo 'session("id)';
});

Auth::routes();

Route::get('/profile', 'manager\ManagerController@manager_profile')->name('manager.profile');

Route::get('/profile/edit', 'manager\ManagerController@edit_profile')->name('managerProfile.edit');
Route::post('/profile/edit', 'manager\ManagerController@update_profile')->name('managerProfile.update');

Route::get('/settings', 'manager\ManagerController@settings')->name('managerProfile.settings');
Route::post('/settings', 'manager\ManagerController@update_password')->name('managerProfile.password');

