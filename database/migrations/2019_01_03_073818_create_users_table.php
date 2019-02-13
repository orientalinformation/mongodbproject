<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('role_id')->unsigned()->nullable()->index('lnk_roles_users');
            $table->string('username', 150);
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('fullname', 100)->nullable();
            $table->dateTime('birthday')->nullable();
            $table->string('address')->nullable();
            $table->boolean('gender')->nullable();
            $table->string('phone', 20)->nullable();
            $table->tinyInteger('civility')->nullable();
            $table->string('first_name', 150)->nullable();
            $table->string('last_name', 150)->nullable();
            $table->string('postal_code', 50)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('sector')->nullable();
            $table->string('interested')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('type')->nullable();
            $table->string('society')->nullable();
            $table->tinyInteger('is_admin')->nullable();
            $table->string('avatar')->nullable();            
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('users', function(Blueprint $table)
        {
            $table->foreign('role_id', 'lnk_roles_users')->references('id')->on('roles')->onUpdate('CASCADE')->onDelete('CASCADE');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropForeign('lnk_roles_users');
        });
        Schema::dropIfExists('users');


    }
}
