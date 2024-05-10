<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPricingColomnsToHotelPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_packages', function (Blueprint $table) {

            $table->double('adult_price')->nullable();
            $table->double('single_price')->nullable();
            $table->double('child_price_under_11')->nullable();
            $table->double('child_price_under_5')->nullable();
            $table->double('infant_price')->nullable();
              
            
            
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel_packages', function (Blueprint $table) {
            //
        });
    }
}
