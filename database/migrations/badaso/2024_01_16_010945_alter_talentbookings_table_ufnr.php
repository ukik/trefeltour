<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTalentbookingsTableUfnr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('talent_bookings', function (Blueprint $table) {
            $table->float('get_daily_price', 10)->charset('')->collation('')->change();
			$table->float('discount', 10)->charset('')->collation('')->change();
        });        Schema::table('talent_bookings', function (Blueprint $table) {
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
        Schema::table('talent_bookings', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
        });
        Schema::table('talent_bookings', function (Blueprint $table) {
            $table->double('get_daily_price', 10,2)->charset('')->collation('')->change();
			$table->double('discount', 10,2)->charset('')->collation('')->change();
        });
    }
}
