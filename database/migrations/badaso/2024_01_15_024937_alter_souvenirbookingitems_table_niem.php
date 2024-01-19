<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSouvenirbookingitemsTableNiem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('souvenir_booking_items', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('souvenir_bookings')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('product_id')->references('id')->on('souvenir_products')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('souvenir_booking_items', function (Blueprint $table) {
            $table->dropForeign(['booking_id']);
			$table->dropForeign(['product_id']);
        });

    }
}
