<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelbookingsTableKsyr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('room_id')->unsigned();
			$table->bigInteger('guest_id')->unsigned();
			$table->dateTime('checkin_date');
			$table->dateTime('checkout_date');
			$table->float('total_price', 10);
			$table->smallInteger('guest_adult');
			$table->smallInteger('guest_children');
			$table->text('special_request');
			$table->timestamps();
        });

        Schema::table('hotel_bookings', function (Blueprint $table) {
            $table->foreign('room_id')->references('id')->on('hotel_rooms')->onDelete('restrict')->onUpdate('no action');
			$table->foreign('guest_id')->references('id')->on('badaso_users')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('hotel_bookings');
    }
}
