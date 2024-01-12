<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropGenreidTableFekl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::dropIfExists('genre_id');

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
        Schema::create('genre_id', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
			$table->bigInteger('cinema_movies_id')->index('cinema_movies_id');
			$table->bigInteger('cinema_genres_id')->index('cinema_genres_id');
			$table->timestamps();
        });
    }
}
