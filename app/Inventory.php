<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'code', 'type', 'name','cost','out_id',
    ];
}
