<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('profile_id')->unsigned();
            $table->bigInteger('org_id')->nullable()->unsigned();

            // foreign keys
            $table->foreign('profile_id')->references('id')
                        ->on('profiles')->onDelete('cascade');
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
        Schema::dropIfExists('profile_links');
    }
}
