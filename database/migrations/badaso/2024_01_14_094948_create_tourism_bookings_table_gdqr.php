<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourismbookingsTableGdqr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('tourism_bookings', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('customer_id')->unsigned();
			$table->bigInteger('tourism_id')->unsigned();
			$table->timestamps();
        });

        Schema::table('tourism_bookings', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('tourism_customers')->onDelete('restrict')->onUpdate('no action');
			$table->foreign('tourism_id')->references('id')->on('tourism')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('tourism_bookings');
    }
}
