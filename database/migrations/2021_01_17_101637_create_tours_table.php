<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('roll_number')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->text('schedule')->nullable();
            $table->text('term')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('vehicle')->nullable();
            $table->unsignedInteger('space')->default(0);
            $table->bigInteger('time_id')->unsigned()->nullable();
            $table->bigInteger('departure_id')->unsigned()->nullable();
            $table->bigInteger('destination_id')->unsigned()->nullable();
            $table->foreign('time_id')->references('id')->on('times')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('departure_id')->references('id')->on('locations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('destination_id')->references('id')->on('locations')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tours');
    }
}
