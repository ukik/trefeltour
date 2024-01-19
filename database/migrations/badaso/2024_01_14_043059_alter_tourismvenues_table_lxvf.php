<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTourismvenuesTableLxvf extends Migration
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
            $table->float('service_price', 10,0)->charset('')->collation('')->change();
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
            $table->double('service_price', 10,0)->charset('')->collation('')->change();
        });
    }
}
