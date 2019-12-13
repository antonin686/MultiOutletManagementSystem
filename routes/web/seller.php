<?php

Route::get('/home', function () {
    return view('seller.home');
});

Auth::routes();
//Route::get('/profile', 'manager\ManagerController@manager_profile')->name('manager.profile');
Route::get('/invoice','seller\SellerController@invoice')->name('invoice');
