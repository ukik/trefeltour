<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTalentskillsTableJxpi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::table('talent_skills', function (Blueprint $table) {
            $table->enum('category', ['guide','media','mc','dance','singer','band','comedian','music player','lainnya'])->charset('')->collation('')->change();
        });        Schema::table('talent_skills', function (Blueprint $table) {
            $table->foreign('talent_id')->references('id')->on('talents')->onDelete('restrict')->onUpdate('no action');
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
        Schema::table('talent_skills', function (Blueprint $table) {
            $table->dropForeign(['talent_id']);
        });
        Schema::table('talent_skills', function (Blueprint $table) {
            $table->enum('category', ['pic','media','mc','dance','singer','band','comedian','music player','lainnya'])->charset('')->collation('')->change();
        });
    }
}
