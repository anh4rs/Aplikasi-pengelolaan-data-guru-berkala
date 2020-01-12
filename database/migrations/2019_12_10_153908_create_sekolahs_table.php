<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekolahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('user_id');
            $table->text('uuid')->nullable();
            $table->string('nama')->length(100);
            $table->string('NPSN')->length(20);
            $table->string('status_sekolah')->length(20);
            $table->string('b_pendidikan')->length(20);
            $table->string('status_pemilik')->length(50);
            $table->string('sk')->length(50);
            $table->date('tgl_sk');
            $table->string('sk_izin')->length(50);
            $table->date('tgl_sk_izin');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sekolahs');
    }
}
