<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSouvenirstoresTableFqpt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('souvenir_stores', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->string('name', 150);
			$table->string('email', 100);
			$table->string('phone', 20);
			$table->text('location');
			$table->text('image');
			$table->text('address');
			$table->bigInteger('user_id')->unsigned();
			$table->timestamps();
        });

        Schema::table('souvenir_stores', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('badaso_users')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('souvenir_stores');
    }
}
