<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryType extends Model
{
    protected $fillable = [
        'type', 'out_id',
    ];
}
