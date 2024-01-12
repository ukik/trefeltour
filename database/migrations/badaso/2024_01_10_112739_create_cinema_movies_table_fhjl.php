<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCinemamoviesTableFhjl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('cinema_movies', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->string('title', 100);
			$table->bigInteger('genre_id')->unsigned();
			$table->time('duration');
			$table->date('release_date');
			$table->timestamps();
        });

        Schema::table('cinema_movies', function (Blueprint $table) {
            $table->foreign('genre_id')->references('id')->on('branches')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('cinema_movies');
    }
}
