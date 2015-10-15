<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformazioni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informazioni', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sezione',200);
            $table->longText('informazione')->nullable();
            $table->timestamp('data_inizio');
            $table->timestamp('data_fine');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('informazioni');
    }
}
