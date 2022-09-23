<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelayanMisaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelayan_misa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_misa');
            $table->unsignedBigInteger('id_misdinar');

            $table->foreign('id_misa')->references('id')->on('misa');
            $table->foreign('id_misdinar')->references('id')->on('misdinar');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelayan_misa');
    }
}
