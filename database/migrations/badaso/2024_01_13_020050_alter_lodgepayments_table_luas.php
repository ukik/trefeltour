<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLodgepaymentsTableLuas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('lodge_payments', function (Blueprint $table) {
            $table->bigInteger('validator_id')->unsigned();
        });

        Schema::table('lodge_payments', function (Blueprint $table) {
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
        Schema::table('lodge_payments', function (Blueprint $table) {
            $table->dropForeign(['validator_id']);
        });
        Schema::table('lodge_payments', function (Blueprint $table) {
            $table->dropColumn('validator_id');
        });


    }
}
