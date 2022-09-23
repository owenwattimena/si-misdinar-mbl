<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMisaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('misa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jadwal_misa');
            $table->string('misa');

            $table->foreign('id_jadwal_misa')->references('id')->on('jadwal_misa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('misa');
    }
}
