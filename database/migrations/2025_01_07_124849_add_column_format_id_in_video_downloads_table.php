<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFormatIdInVideoDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_downloads', function (Blueprint $table) {
            $table->unsignedBigInteger('format_id')->after('resource_id')->nullable();
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
        Schema::table('video_downloads', function (Blueprint $table) {
            $table->dropForeign('video_downloads_format_id_foreign');
            $table->dropColumn('format_id');
        });
    }
}
