<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTableDrmb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('cars', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('branch_id')->unsigned();
			$table->string('brand', 100);
			$table->float('rental_price', 100);
			$table->text('description');
			$table->string('image', 100);
			$table->integer('is_available');
			$table->integer('is_used');
			$table->timestamps();
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('cars');
    }
}
