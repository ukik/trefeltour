<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourismvenuesTableQmyi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('tourism_venues', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->bigInteger('tourism_id')->unsigned();
			$table->string('name', 150);
			$table->string('type', 100);
			$table->text('description');
			$table->float('ticket_price', 10);
			$table->timestamps();
        });

        Schema::table('tourism_venues', function (Blueprint $table) {
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
        Schema::dropIfExists('tourism_venues');
    }
}
