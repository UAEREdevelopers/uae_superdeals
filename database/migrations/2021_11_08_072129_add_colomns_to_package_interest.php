<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColomnsToPackageInterest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('package_interests', function (Blueprint $table) {
            $table->integer('no_of_children_under_5')->nullable();
            $table->integer('no_of_infants')->nullable();
            $table->string('date',12)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('package_interests', function (Blueprint $table) {
            //
        });
    }
}
