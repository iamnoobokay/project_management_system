<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('project_id')->unsigned();
            $table->bigInteger('members_id')->unsigned();
            $table->date('deadline');
            $table->string('status');
            $table->longText('message');
            $table->string('priority');
            $table->timestamps();
        });

        Schema::table('tasks', function($table)
        {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::table('tasks', function($table)
        {
            $table->foreign('members_id')->references('id')->on('members')->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
