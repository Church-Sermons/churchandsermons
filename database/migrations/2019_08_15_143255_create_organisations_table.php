<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('logo');
            $table->string('website', 150);
            $table->decimal('average_review', 3, 3)->nullable();
            $table->longText('description');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            // foreign key
            $table->foreign('category_id')->references('id')
                    ->on('organisation_categories')->onDelete('set null');
            $table->foreign('user_id')->references('id')
                    ->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('organisations');
    }
}
