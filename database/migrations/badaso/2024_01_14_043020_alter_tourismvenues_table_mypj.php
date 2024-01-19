<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTourismvenuesTableMypj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('tourism_venues', function (Blueprint $table) {
            $table->renameColumn('ticket_price', 'service_price');
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

        Schema::table('tourism_venues', function (Blueprint $table) {
            $table->renameColumn('service_price', 'ticket_price');
        });
    }
}
