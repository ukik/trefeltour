<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRentbookingsTableHxzw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('rent_bookings', function (Blueprint $table) {
            $table->bigInteger('unit_id')->unsigned();
        });

        Schema::table('rent_bookings', function (Blueprint $table) {
            $table->foreign('unit_id')->references('id')->on('rent_units')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('rent_bookings', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
        });
        Schema::table('rent_bookings', function (Blueprint $table) {
            $table->dropColumn('unit_id');
        });


    }
}
