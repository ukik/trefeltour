<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSouvenirordersTablePjhy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('souvenir_orders', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('customer_id')->unsigned();
			$table->date('date_pick');
			$table->enum('shipping', ['cod','delivery','pickup']);
			$table->enum('is_cancelled', ['yes','no'])->default('no');
			$table->float('discount', 10);
			$table->timestamps();
        });

        Schema::table('souvenir_orders', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('souvenir_customers')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('souvenir_orders');
    }
}
