<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpo2020DealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expo2020_deals', function (Blueprint $table) {
            $table->id(); 
            $table->string('unique_id')->nullable();           
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('price');
             $table->string('days_selected')->nullable();
            $table->string('hotel_selected')->nullable();;
            $table->string('payment_status')->nullable();
            $table->string('booking_status')->nullable();
           
            
            $table->string('payment_gateway_id')->nullable();
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
        Schema::dropIfExists('expo2020_deals');
    }
}
