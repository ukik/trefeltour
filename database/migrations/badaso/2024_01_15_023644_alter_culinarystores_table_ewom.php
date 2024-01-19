<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCulinarystoresTableEwom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('culinary_stores', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('badaso_users')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('culinary_stores', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

    }
}
