<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoConversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_conversions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('video_cut_id');
            $table->string('path');
            $table->unsignedBigInteger('size');
            $table->timestamps();

            $table->foreign('video_cut_id')->references('id')->on('video_cuts')
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
        Schema::dropIfExists('video_conversions');
    }
}
