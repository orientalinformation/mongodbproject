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
