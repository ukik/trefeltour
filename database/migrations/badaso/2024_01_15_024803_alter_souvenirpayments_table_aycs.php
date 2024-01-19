<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSouvenirpaymentsTableAycs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('souvenir_payments', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('souvenir_bookings')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('souvenir_payments', function (Blueprint $table) {
            $table->dropForeign(['booking_id']);
        });

    }
}
