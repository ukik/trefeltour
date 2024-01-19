<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRentunitsTableVsxb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('rent_units', function (Blueprint $table) {
            $table->bigInteger('store_id')->unsigned();
        });

        Schema::table('rent_units', function (Blueprint $table) {
            $table->foreign('store_id')->references('id')->on('rent_stores')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('rent_units', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
        });
        Schema::table('rent_units', function (Blueprint $table) {
            $table->dropColumn('store_id');
        });


    }
}
