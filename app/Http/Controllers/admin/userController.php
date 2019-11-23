<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class userController extends Controller
{
    function getList()
    {
        error_log(auth()->user());
        print(auth()->user());
    }
}
