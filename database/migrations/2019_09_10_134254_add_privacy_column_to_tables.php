<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrivacyColumnToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table
                ->bigInteger('privacy_id')
                ->unsigned()
                ->nullable()
                ->after('user_id');
            $table
                ->foreign('privacy_id')
                ->references('id')
                ->on('privacy')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign(['privacy_id']);
            $table->dropColumn('privacy_id');
        });
    }
}
