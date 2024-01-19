<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLodgebookingsTableAmud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('lodge_bookings', function (Blueprint $table) {
            $table->foreign('room_id')->references('id')->on('lodge_rooms')->onDelete('restrict')->onUpdate('no action');
			$table->foreign('guest_id')->references('id')->on('badaso_users')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('lodge_bookings', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
			$table->dropForeign(['guest_id']);
        });

    }
}
