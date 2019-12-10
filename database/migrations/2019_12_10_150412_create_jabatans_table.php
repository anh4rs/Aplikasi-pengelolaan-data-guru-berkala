<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJabatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jabatans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('golongan_id');
            $table->text('uuid')->nullable();
            $table->string('kode_jabatan')->length(25);
            $table->string('jabatan')->length(100);
            $table->timestamps();
            $table->foreign('golongan_id')->references('id')->on('golongans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jabatans');
    }
}
