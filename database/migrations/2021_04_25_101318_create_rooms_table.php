<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string("thumbnail")->nullable();
            $table->string("name")->nullable();
            $table->integer("area")->default(0);
            $table->integer("space")->default(0);
            $table->string("position")->nullable();
            $table->string("options")->nullable();
            $table->integer("price")->default(0);
            $table->integer("qty")->default(0);
            $table->text("note")->nullable();
            $table->string("convenients")->nullable();
            $table->bigInteger('hotel_id')->unsigned()->nullable();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('rooms');
    }
}
