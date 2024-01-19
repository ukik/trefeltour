<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSouvenirbookingsTableXzkf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('souvenir_bookings', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict')->onUpdate('no action');
			$table->foreign('store_id')->references('id')->on('souvenir_stores')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('souvenir_bookings', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
			$table->dropForeign(['store_id']);
        });

    }
}
