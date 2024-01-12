<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCinemamoviesTableAsrp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('cinema_movies', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
			$table->foreign('genre_id')->references('id')->on('cinema_genres')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::table('cinema_movies', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
			$table->foreign('genre_id')->references('id')->on('branches');
        });

    }
}
