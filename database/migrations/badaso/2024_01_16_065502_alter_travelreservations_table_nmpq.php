<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTravelreservationsTableNmpq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('travel_reservations', function (Blueprint $table) {
            DB::statement('ALTER TABLE travel_reservations ALTER COLUMN customer_id DROP DEFAULT');
        });        Schema::table('travel_reservations', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('travel_reservations', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
        });
        Schema::table('travel_reservations', function (Blueprint $table) {
            $table->bigInteger('customer_id')->charset('')->collation('')->change();
        });
    }
}
