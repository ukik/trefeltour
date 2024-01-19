<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTravelpaymentsTableKypv extends Migration
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
            DB::statement('ALTER TABLE travel_payments ALTER COLUMN total_amount DROP DEFAULT');
        });        Schema::table('travel_payments', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('travel_bookings')->onDelete('restrict')->onUpdate('no action');
			$table->foreign('validator_id')->references('id')->on('badaso_users')->onDelete('restrict')->onUpdate('no action');
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
            $table->dropForeign(['booking_id']);
			$table->dropForeign(['validator_id']);
        });
        Schema::table('travel_payments', function (Blueprint $table) {
            $table->decimal('total_amount', 10,2)->default(0.00)->charset('')->collation('')->change();
        });
    }
}
