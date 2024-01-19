<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCulinarybuffetbookingsTableBrwz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('culinary_buffet_bookings', function (Blueprint $table) {
            $table->renameColumn('store_id', 'buffet_id');
        });        Schema::table('culinary_buffet_bookings', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict')->onUpdate('no action');
			$table->foreign('buffet_id')->references('id')->on('culinary_buffets')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('culinary_buffet_bookings', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
			$table->dropForeign(['buffet_id']);
        });
        Schema::table('culinary_buffet_bookings', function (Blueprint $table) {
            $table->renameColumn('buffet_id', 'store_id');
        });
    }
}
