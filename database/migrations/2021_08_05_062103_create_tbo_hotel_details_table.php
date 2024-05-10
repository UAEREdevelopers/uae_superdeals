<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTboHotelDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbo_hotel_details', function (Blueprint $table) {
            $table->id();
            $table->string('HotelRating',10);
            $table->string('HotelName',150);
            $table->string('HotelCode',10);
            $table->string('Address',255);
            $table->longText('Description');
            $table->string('FaxNumber',25);
            $table->string('Map',100);
            $table->string('PhoneNumber',30);
            $table->string('PinCode',8);
            $table->string('TripAdvisorRating',5);
            $table->string('CityName',100);
            $table->longText('Attractions');
            $table->longText('facilities');
            $table->longText('images');
            $table->longText('rooms');
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
        Schema::dropIfExists('tbo_hotel_details');
    }
}
