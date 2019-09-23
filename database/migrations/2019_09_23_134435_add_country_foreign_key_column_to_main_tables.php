<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountryForeignKeyColumnToMainTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organisations', function (Blueprint $table) {
            $table
                ->bigInteger('country_id')
                ->unsigned()
                ->nullable()
                ->after('user_id');

            $table
                ->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('set null');
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table
                ->bigInteger('country_id')
                ->unsigned()
                ->nullable()
                ->after('privacy_id');

            $table
                ->foreign('country_id')
                ->references('id')
                ->on('countries')
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
        Schema::table('organisations', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropColumn('country_id');
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropColumn('country_id');
        });
    }
}
