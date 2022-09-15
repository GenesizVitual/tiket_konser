<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tiket', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->unsignedBigInteger('id_event');
            $table->unsignedBigInteger('id_pemesan');
            $table->enum('status',['checked','unchecked'])->default('unchecked');
            $table->timestamps();

            $table->foreign('id_event')->references('id')->on('tbl_event')->onDelete('cascade');
            $table->foreign('id_pemesan')->references('id')->on('tbl_pemesan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_tiket');
    }
}
