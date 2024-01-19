<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalcarsTableAxcr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('rental_cars', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->string('stnk', 20);
			$table->string('model', 100);
			$table->string('brand', 100);
			$table->enum('fuel_type', ['bensin','solar','listrik']);
			$table->float('daily_price', 10);
			$table->enum('is_available', ['available','not available']);
			$table->smallInteger('year_made');
			$table->float('basic_daily_price', 10);
			$table->string('color', 100);
			$table->string('name', 100);
			$table->timestamps();
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
        Schema::dropIfExists('rental_cars');
    }
}
