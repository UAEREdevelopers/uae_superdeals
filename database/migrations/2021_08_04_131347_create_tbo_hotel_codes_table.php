<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTboHotelCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbo_hotel_codes', function (Blueprint $table) {
            $table->id();
            $table->string('HotelCode', 8);
            $table->string('HotelName',150);
            $table->string('HotelAddress',255);
            $table->string('StarRating',50);
            $table->string('Longitude',50);
            $table->string('Latitude',50);
            $table->string('CountryCode',20);
            $table->string('CityName',100);
            $table->string('CountryName',100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbo_hotel_codes');
    }
}
