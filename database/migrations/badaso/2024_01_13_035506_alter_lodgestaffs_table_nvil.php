<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLodgestaffsTableNvil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('lodge_staffs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('badaso_users')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('lodge_staffs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
			$table->dropForeign(['lodge_id']);
        });

    }
}
