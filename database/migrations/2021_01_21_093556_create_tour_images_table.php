<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_images', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default(0);
            $table->string('thumbnail')->nullable();
            $table->bigInteger('tour_id')->unsigned()->nullable();
            $table->foreign('tour_id')->references('id')->on('tours')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tour_images');
    }
}
