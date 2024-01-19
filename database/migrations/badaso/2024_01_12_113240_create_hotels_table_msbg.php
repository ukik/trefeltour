<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTableMsbg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('hotels', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->string('name', 150);
			$table->text('address');
			$table->string('phone', 25);
			$table->string('email', 150);
			$table->smallInteger('starts');
			$table->time('checkin_time');
			$table->time('checkout_time');
			$table->smallInteger('codepos');
			$table->string('city', 100);
			$table->string('country', 100);
			$table->smallInteger('rooms');
			$table->timestamps();
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
        Schema::dropIfExists('hotels');
    }
}
