<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSouvenirproductsTableSbpk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('souvenir_products', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('store_id')->unsigned();
			$table->string('name', 150);
			$table->float('price', 10);
			$table->text('description');
			$table->smallInteger('stock');
			$table->float('discount', 10);
			$table->enum('is_available', ['yes','no']);
			$table->timestamps();
        });

        Schema::table('souvenir_products', function (Blueprint $table) {
            $table->foreign('store_id')->references('id')->on('souvenir_stores')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('souvenir_products');
    }
}
