<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLodgeroomsTableUobq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('lodge_rooms', function (Blueprint $table) {
            $table->renameColumn('hotel_room_type_id', 'lodge_room_type_id');
			$table->renameColumn('hotel_id', 'lodge_id');
        });        Schema::table('lodge_rooms', function (Blueprint $table) {
            $table->foreign('lodge_room_type_id')->references('id')->on('lodge_room_types')->onDelete('restrict')->onUpdate('no action');
			$table->foreign('lodge_id')->references('id')->on('lodge')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('lodge_rooms', function (Blueprint $table) {
            $table->dropForeign(['lodge_room_type_id']);
			$table->dropForeign(['lodge_id']);
        });
        Schema::table('lodge_rooms', function (Blueprint $table) {
            $table->renameColumn('lodge_room_type_id', 'hotel_room_type_id');
			$table->renameColumn('lodge_id', 'hotel_id');
        });
    }
}
