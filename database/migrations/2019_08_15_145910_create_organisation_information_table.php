<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 150);
            $table->mediumText('address');
            $table->decimal('lat')->nullable();
            $table->decimal('lon')->nullable();
            $table->string('phone', 20);
            $table->bigInteger('org_id')->unsigned();
            $table->timestamps();

            // foreign key
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
        Schema::dropIfExists('organisation_information');
    }
}
