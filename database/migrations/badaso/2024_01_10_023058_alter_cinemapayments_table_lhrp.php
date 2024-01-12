<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCinemapaymentsTableLhrp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('cinema_payments', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
        });

        Schema::table('cinema_payments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('badaso_users')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::table('cinema_payments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('cinema_payments', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });


    }
}
