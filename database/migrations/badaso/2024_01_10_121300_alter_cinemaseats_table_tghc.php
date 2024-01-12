<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCinemaseatsTableTghc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('cinema_seats', function (Blueprint $table) {
            $table->string('seat_number', 100);
			$table->enum('seat_status', ['available','not available']);
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

        Schema::table('cinema_seats', function (Blueprint $table) {
            $table->dropColumn('seat_number');
			$table->dropColumn('seat_status');
        });


    }
}
