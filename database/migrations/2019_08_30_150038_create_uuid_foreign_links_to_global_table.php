<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUuidForeignLinksToGlobalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {

            Schema::table('reviews', function (Blueprint $table) {
                $table->uuid('uuid_link')->after('user_id');

            });

            Schema::table('claims', function (Blueprint $table) {
                $table->uuid('uuid_link')->after('sender_id');
            });

            Schema::table('contacts', function (Blueprint $table) {
                $table->uuid('uuid_link')->after('message');
            });

            Schema::table('resource_links', function (Blueprint $table) {
                $table->uuid('uuid_link');
            });

            Schema::table('profile_links', function (Blueprint $table) {
                $table->uuid('uuid_link');
            });

            Schema::table('events', function (Blueprint $table) {
                $table->uuid('uuid_link')->after('poster');

            });
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
