<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('checkin');
            $table->time('checkout')->nullable();
            $table->date('date');
            $table->float('hours')->nullable();
            $table->string('work_details')->nullable();
            $table->string('tomorrow_work')->nullable();
            $table->bigInteger('user_id')->unsigned();
        });

        Schema::table('checkins', function($table)
        {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkins');
    }
}
