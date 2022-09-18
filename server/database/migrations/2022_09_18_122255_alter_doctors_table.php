<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->foreignId('special_id')->constrained('specialities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['special_id']);
            $table->dropColumn('special_id');
        });
    }
}
