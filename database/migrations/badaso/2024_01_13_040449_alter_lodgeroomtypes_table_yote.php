<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLodgeroomtypesTableYote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('lodge_room_types', function (Blueprint $table) {
            $table->renameColumn('price', 'room_price');
			$table->renameColumn('basic_price', 'basic_room_price');
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
        Schema::table('lodge_room_types', function (Blueprint $table) {
            $table->renameColumn('room_price', 'price');
			$table->renameColumn('basic_room_price', 'basic_price');
        });
    }
}
