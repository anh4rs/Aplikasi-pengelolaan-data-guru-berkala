<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sekolah_id');
            $table->unsignedBigInteger('golongan_id');
            $table->unsignedBigInteger('jabatan_id');
            $table->unsignedBigInteger('mata_pelajaran_id')->nullable();
            $table->text('uuid')->nullable();
            $table->string('NIP')->length(50);
            $table->string('telepon')->length(13);
            $table->string('tempat_lahir')->length(100);
            $table->date('tgl_lahir')->length(100);
            $table->text('alamat');
            $table->string('status')->length(25);
            $table->timestamps();
            $table->foreign('sekolah_id')->references('id')->on('sekolahs')->onDelete('cascade');
            $table->foreign('golongan_id')->references('id')->on('golongans')->onDelete('cascade');
            $table->foreign('jabatan_id')->references('id')->on('jabatans')->onDelete('cascade');
            $table->foreign('mata_pelajaran_id')->references('id')->on('mata_pelajarans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gurus');
    }
}
