<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePejabatStrukturalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pejabat_strukturals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('golongan_id')->nullable();
            $table->text('uuid')->nullable();
            $table->string('NIP')->length(50);
            $table->string('nama')->length(100);
            $table->string('jabatan')->length(50);
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
        Schema::dropIfExists('pejabat_strukturals');
    }
}
