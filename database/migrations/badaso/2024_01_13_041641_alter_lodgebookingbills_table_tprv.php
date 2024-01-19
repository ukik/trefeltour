<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLodgebookingbillsTableTprv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('lodge_booking_bills', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('lodge_bookings')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('lodge_booking_bills', function (Blueprint $table) {
            $table->dropForeign(['booking_id']);
			$table->dropForeign(['user_id']);
        });

    }
}
