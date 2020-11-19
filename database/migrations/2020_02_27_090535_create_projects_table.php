<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('manager_id')->unsigned();
            $table->bigInteger('department_id')->unsigned();
            $table->string('project_name');
            $table->string('client_name');
            $table->string('client_contact');
            $table->string('client_email');
            $table->date('deadline');
            $table->string('status');
            $table->timestamps();
        });

        Schema::table('projects', function($table)
        {
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::table('projects', function($table)
        {
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade')
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
        Schema::dropIfExists('projects');
    }
}
