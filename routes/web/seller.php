<?php

Route::get('/home', function () {
    return view('seller.home');
});

Auth::routes();
//Route::get('/profile', 'manager\ManagerController@manager_profile')->name('manager.profile');
Route::get('/invoice','seller\SellerController@invoice')->name('invoice');
Route::get('/invoice/searchAjax','seller\SellerController@getCost')->name('getCost');//ajax request
Route::post('/invoice','seller\SellerController@submitBill');


Route::get('/food-items','seller\SellerController@items')->name('items');

Route::get('/order-status','seller\SellerController@Osatus')->name('Ostatus');
Route::get('/order-status/{id}','seller\SellerController@served')->name('served');

Route::get('/insert-raw-goods','seller\SellerController@goodsEntry')->name('goodsEntry');
Route::get('/insert-raw-goods/searchAjax','seller\SellerController@goodsBal')->name('getGoodsBal');
Route::post('/insert-raw-goods','seller\SellerController@submitRawGoods');

Route::get('/packed-food-ingredient','seller\SellerController@packedFood')->name('packedFood');
Route::post('/packed-food-ingredient','seller\SellerController@packedFoodInsert');

Route::get('/inventory','seller\SellerController@viewInventory')->name('inventory');
