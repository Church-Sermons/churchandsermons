<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('resource_id')->unsigned();
            $table->bigInteger('org_id')->nullable()->unsigned();
            $table->bigInteger('profile_id')->nullable()->unsigned();

            // foreign
            $table->foreign('resource_id')->references('id')
                        ->on('resources')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')
                        ->on('profiles')->onDelete('set null');
            $table->foreign('org_id')->references('id')
                        ->on('organisations')->onDelete('set null');
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
        Schema::dropIfExists('resource_links');
    }
}
