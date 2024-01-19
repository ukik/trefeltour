<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourismcartsTableQlba extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('tourism_carts', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('product_id')->unsigned();
			$table->smallInteger('quantity');
			$table->float('total_price', 10);
			$table->timestamps();
        });

        Schema::table('tourism_carts', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('souvenir_products')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('tourism_carts');
    }
}
