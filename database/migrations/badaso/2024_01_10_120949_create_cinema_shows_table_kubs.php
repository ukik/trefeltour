<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCinemashowsTableKubs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('cinema_shows', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('movie_id')->unsigned();
			$table->bigInteger('studio_id')->unsigned();
			$table->dateTime('showtime');
			$table->timestamps();
        });

        Schema::table('cinema_shows', function (Blueprint $table) {
            $table->foreign('movie_id')->references('id')->on('cinema_movies')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('studio_id')->references('id')->on('cinema_studios')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('cinema_shows');
    }
}
