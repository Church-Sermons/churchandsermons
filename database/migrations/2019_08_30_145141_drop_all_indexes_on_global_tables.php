<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAllIndexesOnGlobalTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['org_id']);
            $table->dropColumn('org_id');
        });

        Schema::table('claims', function (Blueprint $table) {
            $table->dropForeign(['org_id']);
            $table->dropColumn('org_id');
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['org_id']);
            $table->dropColumn('org_id');
        });

        Schema::table('resource_links', function (Blueprint $table) {
            $table->dropForeign(['org_id']);
            $table->dropForeign(['profile_id']);
            $table->dropColumn(['org_id', 'profile_id']);
        });

        Schema::table('profile_links', function (Blueprint $table) {
            $table->dropForeign(['org_id']);
            $table->dropColumn('org_id');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['org_id']);
            $table->dropColumn('org_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            //
        });
    }
}
