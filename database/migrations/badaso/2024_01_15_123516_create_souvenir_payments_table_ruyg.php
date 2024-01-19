<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSouvenirpaymentsTableRuyg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('souvenir_payments', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('booking_id')->unsigned();
			$table->timestamps();
        });

        Schema::table('souvenir_payments', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('souvenir_bookings')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('souvenir_payments');
    }
}
