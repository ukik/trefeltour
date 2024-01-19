<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTravelpaymentsTableMzou extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('travel_payments', function (Blueprint $table) {
            $table->renameColumn('booking_id', 'ticket_id');
        });        Schema::table('travel_payments', function (Blueprint $table) {
            $table->foreign('ticket_id')->references('id')->on('travel_tickets')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('travel_payments', function (Blueprint $table) {
            $table->dropForeign(['ticket_id']);
        });
        Schema::table('travel_payments', function (Blueprint $table) {
            $table->renameColumn('ticket_id', 'booking_id');
        });
    }
}
