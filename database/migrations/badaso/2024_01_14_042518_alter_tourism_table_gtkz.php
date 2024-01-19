<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTourismTableGtkz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('tourism', function (Blueprint $table) {
            $table->string('email', 200);
			$table->string('phone', 20);
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
        Schema::table('tourism', function (Blueprint $table) {
            $table->dropColumn('email');
			$table->dropColumn('phone');
        });


    }
}
