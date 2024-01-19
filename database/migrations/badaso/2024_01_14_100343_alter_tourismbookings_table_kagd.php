<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTourismbookingsTableKagd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('tourism_bookings', function (Blueprint $table) {
            $table->enum('ticket_type', ['adult','kid']);
			$table->float('get_ticket_price', 10);
			$table->float('discount', 10);
			$table->date('date');
			$table->smallInteger('day_duration');
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

        Schema::table('tourism_bookings', function (Blueprint $table) {
            $table->dropColumn('ticket_type');
			$table->dropColumn('get_ticket_price');
			$table->dropColumn('discount');
			$table->dropColumn('date');
			$table->dropColumn('day_duration');
        });


    }
}
