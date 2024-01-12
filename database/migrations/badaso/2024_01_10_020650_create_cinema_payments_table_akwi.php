<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCinemapaymentsTableAkwi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('cinema_payments', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('ticket_id')->unsigned();
			$table->dateTime('payment_date');
			$table->string('price', 100);
			$table->text('payment_receipt');
			$table->enum('status', ['pending','success']);
			$table->timestamps();
        });

        Schema::table('cinema_payments', function (Blueprint $table) {
            $table->foreign('ticket_id')->references('id')->on('cinema_tickets')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('cinema_payments');
    }
}
