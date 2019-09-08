<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid_link');
            $table->bigInteger('social_id')->unsigned();
            $table->string('page_link')->nullable();
            $table->string('share_link')->nullable();
            $table->timestamps();

            $table
                ->foreign('social_id')
                ->references('id')
                ->on('social_media')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_links');
    }
}
