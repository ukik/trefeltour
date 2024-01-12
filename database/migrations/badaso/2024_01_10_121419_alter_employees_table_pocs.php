<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEmployeesTablePocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('employees', function (Blueprint $table) {
            $table->string('position', 100);
			$table->string('status', 100);
			$table->string('status_booking', 100);
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

        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('position');
			$table->dropColumn('status');
			$table->dropColumn('status_booking');
        });


    }
}
