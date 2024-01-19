<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentrentalsTableYoik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('rent_rentals', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('customer_id')->unsigned();
			$table->bigInteger('driver_id')->unsigned();
			$table->bigInteger('days');
			$table->dateTime('date_rent');
			$table->dateTime('time_depart');
			$table->dateTime('time_arrive');
			$table->text('destination');
			$table->float('rental_fee', 10);
			$table->float('fuel_fee', 10);
			$table->float('insurance_fee', 10);
			$table->float('discount', 10);
			$table->timestamps();
        });

        Schema::table('rent_rentals', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('rent_customer')->onDelete('restrict')->onUpdate('no action');
			$table->foreign('driver_id')->references('id')->on('rent_drivers')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('rent_rentals');
    }
}
