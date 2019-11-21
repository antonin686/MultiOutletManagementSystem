<?php

Route::get('/home', function () {
    return view('manager.home');
});

Auth::routes();

