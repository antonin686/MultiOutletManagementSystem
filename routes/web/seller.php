<?php

Route::get('/home', function () {
    return view('seller.home');
});

Auth::routes();

