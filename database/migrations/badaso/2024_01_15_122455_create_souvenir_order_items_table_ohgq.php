<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSouvenirorderitemsTableOhgq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('souvenir_order_items', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('order_id')->unsigned();
			$table->bigInteger('product_id')->unsigned();
			$table->timestamps();
        });

        Schema::table('souvenir_order_items', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('souvenir_orders')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('product_id')->references('id')->on('souvenir_products')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('souvenir_order_items');
    }
}
