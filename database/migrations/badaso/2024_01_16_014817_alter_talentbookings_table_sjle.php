<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTalentbookingsTableSjle extends Migration
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
            $table->bigInteger('store_id')->unsigned();
        });

        Schema::table('talent_bookings', function (Blueprint $table) {
            $table->foreign('store_id')->references('id')->on('talents')->onDelete('restrict')->onUpdate('no action');
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
            $table->dropForeign(['store_id']);
        });
        Schema::table('talent_bookings', function (Blueprint $table) {
            $table->dropColumn('store_id');
        });


    }
}
