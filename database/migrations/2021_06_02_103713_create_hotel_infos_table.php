<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_infos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('HCode');
            $table->string('HName');
            $table->string('Address');
            $table->string('city');
            $table->string('Country');
            $table->string('Image');
            $table->string('Location');
            $table->string('Description');
            $table->string('Latitude');
            $table->string('Longitude');
            $table->string('StarRating');
            $table->integer('CityId');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_infos');
    }
}
