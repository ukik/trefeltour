<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterHotelsTableIezu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('hotels', function (Blueprint $table) {
            $table->enum('lang_id', ['yes','no'])->default('yes');
			$table->enum('lang_en', ['yes','no'])->default('no');
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
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('lang_id');
			$table->dropColumn('lang_en');
        });


    }
}
