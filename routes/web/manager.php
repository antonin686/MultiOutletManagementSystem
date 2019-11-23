<?php

Route::get('/home', function () {
    //Session::put('id','bitch pls');
   // Session::flush();
    return view('manager.home')->with("title","Manager Dashboard");
    echo 'session("id)';
});

Auth::routes();

Route::post('/logout', function(){
    Session::flush();
    return redirect('/login');
});

