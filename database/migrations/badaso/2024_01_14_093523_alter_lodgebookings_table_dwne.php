<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLodgebookingsTableDwne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('lodge_bookings', function (Blueprint $table) {
            $table->renameColumn('guest_id', 'customer_id');
        });        Schema::table('lodge_bookings', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('lodge_customers')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('lodge_bookings', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
        });
        Schema::table('lodge_bookings', function (Blueprint $table) {
            $table->renameColumn('customer_id', 'guest_id');
        });
    }
}
