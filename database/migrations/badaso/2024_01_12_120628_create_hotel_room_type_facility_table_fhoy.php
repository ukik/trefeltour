<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelroomtypefacilityTableFhoy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('hotel_room_type_facility', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('hotel_room_type_id')->unsigned();
			$table->text('primer');
			$table->text('internet');
			$table->text('relax');
			$table->text('clean_safety');
			$table->text('service');
			$table->text('children');
			$table->text('access');
			$table->text('transport');
			$table->text('availability');
			$table->timestamps();
        });

        Schema::table('hotel_room_type_facility', function (Blueprint $table) {
            $table->foreign('hotel_room_type_id')->references('id')->on('hotel_room_types')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('hotel_room_type_facility');
    }
}
