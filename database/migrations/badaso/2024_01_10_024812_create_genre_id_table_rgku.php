<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreidTableRgku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('genre_id', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('cinema_movies_id')->unsigned();
			$table->bigInteger('cinema_genres_id')->unsigned();
			$table->timestamps();
        });

        Schema::table('genre_id', function (Blueprint $table) {
            $table->foreign('cinema_movies_id')->references('id')->on('cinema_movies')->onDelete('cascade')->onUpdate('restrict');
			$table->foreign('cinema_genres_id')->references('id')->on('cinema_genres')->onDelete('cascade')->onUpdate('restrict');
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
        Schema::dropIfExists('genre_id');
    }
}
