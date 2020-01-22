<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataBerkalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_berkalas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sekolah_id');
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('pejabat_struktural_id');
            $table->text('uuid')->nullable();
            $table->string('nomor_surat')->length(50);
            $table->string('lampiran')->length(50);
            $table->string('perihal')->length(50);
            $table->string('gaji_lama')->length(100);
            $table->date('tgl_keputusan');
            $table->string('no_keputusan')->length(50);
            $table->date('tgl_gaji_berlaku');
            $table->string('mkg')->length(50);
            $table->string('gaji_baru')->length(100);
            $table->string('terbilang')->length(100);
            $table->date('tgl_gaji_berikut');
            $table->string('status')->default('0');
            $table->timestamps();
            $table->foreign('sekolah_id')->references('id')->on('sekolahs')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
            $table->foreign('pejabat_struktural_id')->references('id')->on('pejabat_strukturals')->onDelete('cascade');
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
