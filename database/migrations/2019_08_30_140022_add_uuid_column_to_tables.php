<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUuidColumnToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organisations', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->after('id');
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->after('id');
        });

        Schema::table('resources', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organisations', function (Blueprint $table) {
            $table->removeColumn('uuid');
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->removeColumn('uuid');
        });

        Schema::table('resources', function (Blueprint $table) {
            $table->removeColumn('uuid');
        });
    }
}
