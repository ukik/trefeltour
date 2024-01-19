<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTourismpaymentsTableMvcg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('tourism_payments', function (Blueprint $table) {
            $table->foreign('validator_id')->references('id')->on('tourism_bookings')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('tourism_payments', function (Blueprint $table) {
            $table->dropForeign(['validator_id']);
        });

    }
}
