<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiklatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diklats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('uuid')->nullable();
            $table->string('kode_diklat')->length(30);
            $table->string('nama')->length(100);
            $table->string('tempat')->length(100);
            $table->string('penyelenggara')->length(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diklats');
    }
}
