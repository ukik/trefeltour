<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourismfacilitiesTablePykd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('tourism_facilities', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('tourism_id')->unsigned();
			$table->enum('toilet', ['yes','no']);
			$table->enum('bathroom', ['yes','no']);
			$table->enum('mushola', ['yes','no']);
			$table->enum('rest_area', ['yes','no']);
			$table->enum('bar', ['yes','no']);
			$table->enum('cafe_resto', ['yes','no']);
			$table->enum('souvenir', ['yes','no']);
			$table->enum('park', ['yes','no']);
			$table->enum('wifi', ['yes','no']);
			$table->enum('security', ['yes','no']);
			$table->enum('medic', ['yes','no']);
			$table->timestamps();
        });

        Schema::table('tourism_facilities', function (Blueprint $table) {
            $table->foreign('tourism_id')->references('id')->on('tourism')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('tourism_facilities');
    }
}
