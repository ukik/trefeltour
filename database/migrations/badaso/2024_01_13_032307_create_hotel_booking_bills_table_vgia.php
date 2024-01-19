<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelbookingbillsTableVgia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('hotel_booking_bills', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('booking_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
			$table->float('room_charge', 10);
			$table->float('service_charge', 10);
			$table->float('restaurant_charge', 10);
			$table->float('bar_charge', 10);
			$table->float('misc_charge', 10);
			$table->float('overtime_charge', 10);
			$table->timestamps();
        });

        Schema::table('hotel_booking_bills', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('hotel_bookings')->onDelete('restrict')->onUpdate('no action');
			$table->foreign('user_id')->references('id')->on('badaso_users')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('hotel_booking_bills');
    }
}
