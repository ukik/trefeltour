<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTravelbookingsTableQbma extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('travel_bookings', function (Blueprint $table) {
            DB::statement('ALTER TABLE travel_bookings ALTER COLUMN reservation_id DROP DEFAULT');
			$table->smallInteger('seat_no')->charset('')->collation('')->change();
			DB::statement('ALTER TABLE travel_bookings ALTER COLUMN ticket_price DROP DEFAULT');
			DB::statement('ALTER TABLE travel_bookings ALTER COLUMN validator_id DROP DEFAULT');
        });        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->foreign('reservation_id')->references('id')->on('travel_reservations')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->dropForeign(['reservation_id']);
			$table->dropForeign(['validator_id']);
        });
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->bigInteger('reservation_id')->charset('')->collation('')->change();
			$table->smallInteger('seat_no')->unsigned()->charset('')->collation('')->change();
			$table->decimal('ticket_price', 10,2)->default(0.00)->charset('')->collation('')->change();
			$table->bigInteger('validator_id')->charset('')->collation('')->change();
        });
    }
}
