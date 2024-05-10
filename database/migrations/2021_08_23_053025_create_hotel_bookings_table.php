<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->bigInteger('user_id')->nullable();
            $table->string('reference_no_to_api');
            $table->string('api_platform')->default('TBO');
            $table->string('status');
            $table->string('BookingId')->nullable();
            $table->string('ConfirmationNo')->nullable();
            $table->string('TripId')->nullable();            
            $table->string('HotelCode');
            $table->string('HotelName');
            $table->string('city');
            $table->string('country');
            $table->string('checkInDate');
            $table->string('checkOutDate');
            $table->string('adults');
            $table->string('children');
            $table->string('rooms');
            $table->string('price');
            $table->longtext('guests');
            $table->longtext('guest_address');
            $table->longtext('searchData');
            $table->longtext('bookingDetails');
            $table->longtext('roomdetails');
             $table->longtext('booking_response_from_api');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_bookings');
    }
}
