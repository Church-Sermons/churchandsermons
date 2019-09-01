<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetMainImagesColumnToNullable extends Migration
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
                ->string('logo')
                ->nullable()
                ->change();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table
                ->string('profile_image')
                ->nullable()
                ->change();
        });

        Schema::table('resources', function (Blueprint $table) {
            $table
                ->string('file_name')
                ->nullable()
                ->change();
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
            $table->string('logo')->change();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->string('profile_image')->change();
        });

        Schema::table('resources', function (Blueprint $table) {
            $table->string('file_name')->change();
        });
    }
}
