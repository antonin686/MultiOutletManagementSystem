<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('out_id');
            $table->bigInteger('table_id');
            $table->bigInteger('status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('outlet_tables');
    }
}
