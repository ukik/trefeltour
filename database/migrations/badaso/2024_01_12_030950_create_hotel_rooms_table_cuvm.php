<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelroomsTableCuvm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('hotel_rooms', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('hotel_room_type_id')->unsigned();
			$table->bigInteger('hotel_id')->unsigned();
			$table->enum('status', ['available','not available']);
			$table->timestamps();
        });

        Schema::table('hotel_rooms', function (Blueprint $table) {
            $table->foreign('hotel_room_type_id')->references('id')->on('hotel_room_types')->onDelete('restrict')->onUpdate('no action');
			$table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('restrict')->onUpdate('no action');
        });

        } catch (PDOException $ex) {
            $this->down();
            throw $ex;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_rooms');
    }
}
