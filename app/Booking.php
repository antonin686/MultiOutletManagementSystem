<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booked_for', 'contact','cus_amount','time','booked_by','table_id','out_id',
    ];
}
