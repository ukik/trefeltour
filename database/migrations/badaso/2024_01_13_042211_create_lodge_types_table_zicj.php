<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLodgetypesTableZicj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('lodge_types', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('lodge_id')->unsigned();
			$table->enum('hotel', ['yes','no']);
			$table->enum('hostel', ['yes','no']);
			$table->enum('boutique_hotel', ['yes','no']);
			$table->enum('resort', ['yes','no']);
			$table->enum('cottage', ['yes','no']);
			$table->enum('motel', ['yes','no']);
			$table->enum('losmen', ['yes','no']);
			$table->enum('inn', ['yes','no']);
			$table->enum('villa', ['yes','no']);
			$table->enum('homestay', ['yes','no']);
			$table->timestamps();
        });

        Schema::table('lodge_types', function (Blueprint $table) {
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
        Schema::dropIfExists('lodge_types');
    }
}
