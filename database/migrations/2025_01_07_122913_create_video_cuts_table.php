<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoCutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_cuts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('video_id');
            $table->unsignedBigInteger('start_time');
            $table->unsignedBigInteger('end_time');
            $table->string('path');
            $table->unsignedBigInteger('size');
            $table->timestamps();

            $table->foreign('video_id')->references('id')->on('videos')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_cuts');
    }
}
