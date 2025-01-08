<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTypeIdInFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formats', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->after('name');
            $table->foreign('type_id')->references('id')->on('types')
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
        Schema::table('formats', function (Blueprint $table) {
            $table->dropForeign('formats_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }
}
