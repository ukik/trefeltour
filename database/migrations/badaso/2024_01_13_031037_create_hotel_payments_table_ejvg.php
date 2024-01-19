<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelpaymentsTableEjvg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('hotel_payments', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('booking_id')->unsigned();
			$table->integer('amount');
			$table->string('method', 100);
			$table->date('date');
			$table->enum('status', ['pending','success']);
			$table->text('receipt');
			$table->timestamps();
        });

        Schema::table('hotel_payments', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('hotel_bookings')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('hotel_payments');
    }
}
