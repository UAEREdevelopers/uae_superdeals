<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title',75);
            $table->string('short_description',150)->nullable();
            $table->longtext('description')->nullable();
            $table->double('price_per_adult',2)->nullable();
            $table->integer('is_package_price')->nullable();
            $table->double('package_price')->nullable();
            $table->integer('no_of_adults_in_package')->nullable();
            $table->integer('no_of_children_in_package')->nullable();
            $table->string('banner_image')->nullable();
            $table->integer('is_active')->nullable();
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
        Schema::dropIfExists('hotel_packages');
    }
}
