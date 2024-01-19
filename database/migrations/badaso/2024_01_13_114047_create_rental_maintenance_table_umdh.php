<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalmaintenanceTableUmdh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('rental_maintenance', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('car_id')->unsigned();
			$table->text('description');
			$table->float('cost', 10);
			$table->dateTime('date_start');
			$table->dateTime('date_finish');
			$table->enum('is_maintenance', ['yes','no']);
			$table->timestamps();
        });

        Schema::table('rental_maintenance', function (Blueprint $table) {
            $table->foreign('car_id')->references('id')->on('rental_cars')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('rental_maintenance');
    }
}
