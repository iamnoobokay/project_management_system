<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('contact_number');
            $table->string('pan_number');
            $table->string('emergency_contact');
            $table->string('emergency_contact_phone');
            $table->string('blood_group');
            $table->string('permanent_address');
            $table->string('temporary_address');
            $table->string('citizenship_number');
            $table->date('date_of_birth')->nullable();
            $table->bigInteger('role_id')->unsigned();
            $table->integer('status');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function($table)
        {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')
            ->onUpdate('cascade');
        });

        $password=bcrypt('password');
        DB::table('users')->insert(
            array(
                'name'=>'Shibesh Duwadi',
                'email'=>'shibeshd96@gmail.com',
                'password'=>$password,
                'contact_number'=>'98398983222',
                'pan_number'=>'34SHIBESH55',
                'emergency_contact'=>'Mr. Duwadi Sr.',
                'emergency_contact_phone'=>'91823888883',
                'blood_group'=>'B+',
                'permanent_address'=>'Sifal,Kathmandu',
                'temporary_address'=>'Sifal,Kathmandu',
                'citizenship_number'=>'271099-123356',
                'role_id'=>3,
                'status'=>1,
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
        Schema::dropIfExists('users');
    }
}
