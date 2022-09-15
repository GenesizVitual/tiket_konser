<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreaateEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_event', function (Blueprint $table) {
            $table->id();
            $table->string('event');
            $table->string('about_event');
            $table->string('banner');
            $table->date('tgl_event');
            $table->enum('status',['ended','comming soon'])->default('comming soon');
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
        Schema::dropIfExists('tbl_event');
    }
}
