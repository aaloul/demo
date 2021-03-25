<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pharmacy_id')->index();
            $table->string('path')->nullable();
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies')->onDelete('cascade');
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
        Schema::dropIfExists('pharmacy_images');
    }
}
