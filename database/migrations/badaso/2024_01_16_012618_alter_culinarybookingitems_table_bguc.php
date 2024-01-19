<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCulinarybookingitemsTableBguc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('culinary_booking_items', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('culinary_products')->onDelete('restrict')->onUpdate('no action');
			$table->foreign('booking_id')->references('id')->on('culinary_bookings')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('culinary_booking_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
			$table->dropForeign(['booking_id']);
        });

    }
}
