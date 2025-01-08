<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFormatIdInVideoConversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_conversions', function (Blueprint $table) {
            $table->unsignedBigInteger('format_id');
            $table->foreign('format_id')->references('id')->on('formats')
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
        Schema::table('video_conversions', function (Blueprint $table) {
            $table->dropForeign('video_conversions_format_id_foreign');
            $table->dropColumn('format_id');
        });
    }
}
