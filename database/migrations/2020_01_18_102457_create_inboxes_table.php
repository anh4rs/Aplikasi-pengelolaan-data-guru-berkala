<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inboxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('sekolah_id');
            $table->unsignedbigInteger('data_berkala_id')->nullable();
            $table->text('uuid')->nullable();
            $table->string('subjek')->length(50);
            $table->text('keterangan');
            $table->tinyInteger('status')->default(0);
            $table->foreign('sekolah_id')->references('id')->on('sekolahs')->onDelete('cascade');
            $table->foreign('data_berkala_id')->references('id')->on('data_berkalas')->onDelete('cascade');
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
        Schema::dropIfExists('inboxes');
    }
}
