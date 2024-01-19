<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCulinarybuffetpaymentsTableNosv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('culinary_buffet_payments', function (Blueprint $table) {
            $table->renameColumn('booking_id', 'buffet_booking_id');
        });        Schema::table('culinary_buffet_payments', function (Blueprint $table) {
            $table->foreign('buffet_booking_id')->references('id')->on('culinary_buffets')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('culinary_buffet_payments', function (Blueprint $table) {
            $table->dropForeign(['buffet_booking_id']);
        });
        Schema::table('culinary_buffet_payments', function (Blueprint $table) {
            $table->renameColumn('buffet_booking_id', 'booking_id');
        });
    }
}
