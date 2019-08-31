<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject');
            $table->mediumText('message');
            $table->bigInteger('sender_id')->unsigned();
            $table->bigInteger('org_id')->unsigned();
            $table->timestamps();

            $table->foreign('sender_id')->references('id')
                        ->on('users')->onDelete('cascade');

            $table->foreign('org_id')->references('id')
                        ->on('organisations')->onDelete('cascade');
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
        Schema::dropIfExists('claims');
    }
}
