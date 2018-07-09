<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year_id')->unsigned();
            $table->integer('grade_id')->unsigned();
            $table->integer('fee_id')->unsigned();
            $table->integer('value')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::table('values', function (Blueprint $table) {
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('grade_id')->references('id')->on('grades');
            $table->foreign('fee_id')->references('id')->on('fees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('values');
    }
}
