<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampusbookingsTableCrpl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('campus_bookings', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('room_id')->unsigned();
			$table->bigInteger('lecturer_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
			$table->dateTime('time_start');
			$table->dateTime('time_end');
			$table->timestamps();
        });

        Schema::table('campus_bookings', function (Blueprint $table) {
            $table->foreign('room_id')->references('id')->on('campus_rooms')->onDelete('restrict')->onUpdate('no action');
			$table->foreign('lecturer_id')->references('id')->on('campus_lectures')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('campus_bookings');
    }
}
