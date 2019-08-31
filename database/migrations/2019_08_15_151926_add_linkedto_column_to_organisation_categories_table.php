<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkedtoColumnToOrganisationCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organisation_categories', function (Blueprint $table) {
            $table->string('linked_to', 150)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organisation_categories', function (Blueprint $table) {
            $table->dropColumn('linked_to');
        });
    }
}
