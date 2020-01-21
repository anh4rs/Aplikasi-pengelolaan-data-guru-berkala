<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajiBerkalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaji_berkalas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('golongan_id');
            $table->text('uuid')->nullable();
            $table->string('mkg')->length(100);
            $table->double('besaran_gaji');
            $table->foreign('golongan_id')->references('id')->on('golongans')->onDelete('cascade');
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
        Schema::dropIfExists('gaji_berkalas');
    }
}
