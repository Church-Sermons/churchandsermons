<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyOrganisationsTableForRefactoring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // drops
        Schema::table('organisations', function (Blueprint $table) {
            // drop columns then move them
            $table->dropColumn(['phone', 'email', 'address', 'lat', 'lon']);

            // make website nullable
            $table
                ->string('website', 150)
                ->nullable()
                ->change();
        });

        // recreations
        Schema::table('organisations', function (Blueprint $table) {
            $table->string('phone', 20)->after('website');
            $table->string('email', 150)->after('name');
        });

        Schema::table('organisations', function (Blueprint $table) {
            $table->mediumText('address')->after('phone');
        });

        Schema::table('organisations', function (Blueprint $table) {
            $table
                ->decimal('lat', 10, 8)
                ->nullable()
                ->after('address');
        });

        Schema::table('organisations', function (Blueprint $table) {
            $table
                ->decimal('lon', 11, 8)
                ->nullable()
                ->after('lat');

            // lat 10,8 lon 11,8
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
            // $table->dropColumn(['phone', 'email', 'address', 'lat', 'lon']);
        });
    }
}
