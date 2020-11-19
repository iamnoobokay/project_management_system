<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role_name');
            $table->timestamps();
        });

        DB::table('roles')->insert(
            array(
                'role_name'=>'Project Manager',
            )
        );

        DB::table('roles')->insert(
            array(
                'role_name'=>'Member',
            )
        );

        DB::table('roles')->insert(
            array(
                'role_name'=>'Admin',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
