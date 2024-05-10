<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColomnThumbnailImageToHotelPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_packages', function (Blueprint $table) {
            $table->string('thumbnail_image')->nullable();
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
