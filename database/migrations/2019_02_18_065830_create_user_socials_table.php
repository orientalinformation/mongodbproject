<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_socials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('token')->nullable();
            $table->integer('user_id')->unsigned()->index('lnk_users_user_socials');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('user_socials', function(Blueprint $table)
        {
            $table->foreign('user_id', 'lnk_users_user_socials')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_socials', function(Blueprint $table)
        {
            $table->dropForeign('lnk_users_user_socials');
        });

        Schema::dropIfExists('user_socials');
    }
}
