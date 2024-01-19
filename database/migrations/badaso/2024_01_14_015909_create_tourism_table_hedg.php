<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourismTableHedg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('tourism', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->string('name', 150);
			$table->text('address');
			$table->string('province', 100);
			$table->string('region', 100);
			$table->string('district', 100);
			$table->text('location');
			$table->enum('day_open', ['senin','selasa','rabu','kamis','jumat','sabtu','minggu']);
			$table->enum('day_close', ['senin','selasa','rabu','kamis','jumat','sabtu','minggu']);
			$table->time('time_open');
			$table->time('time_close');
			$table->text('policy');
			$table->text('description');
			$table->float('ticket_price', 10);
			$table->float('discount_price', 10);
			$table->enum('is_available', ['yes','no']);
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
        Schema::dropIfExists('tourism');
    }
}
