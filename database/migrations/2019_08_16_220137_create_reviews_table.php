<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('rating', 3, 2);
            $table->mediumText('message');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('org_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')
                            ->on('users')->onDelete('set null');
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
        Schema::dropIfExists('reviews');
    }
}
