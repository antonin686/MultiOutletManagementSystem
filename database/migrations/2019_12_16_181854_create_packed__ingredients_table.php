<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackedIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packed__ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prod_name');
            $table->string('prod_type');
            $table->string('cost');
            $table->date('buy_date');
            $table->date('exp_date');
            $table->bigInteger('out_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packed__ingredients');
    }
}
