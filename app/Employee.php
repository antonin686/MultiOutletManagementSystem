<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'emp_name', 'contact', 'salary', 'out_id', 'img', 'log_id'
    ];
}
