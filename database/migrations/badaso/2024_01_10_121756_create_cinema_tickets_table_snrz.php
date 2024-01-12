<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCinematicketsTableSnrz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('cinema_tickets', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('seat_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('movie_id')->unsigned();
			$table->string('code_ticket', 100);
			$table->dateTime('purchase_date');
			$table->timestamps();
        });

        Schema::table('cinema_tickets', function (Blueprint $table) {
            $table->foreign('seat_id')->references('id')->on('cinema_seats')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('user_id')->references('id')->on('badaso_users')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('movie_id')->references('id')->on('cinema_movies')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('cinema_tickets');
    }
}
