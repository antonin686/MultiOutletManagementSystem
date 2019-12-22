<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTypesTable extends Migration
{
    
    public function up()
    {
        Schema::create('inventory_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_types');
    }
}
