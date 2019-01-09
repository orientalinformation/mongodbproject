<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned()->index('lnk_roles_permission_roles');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('permission_roles', function(Blueprint $table)
        {
            $table->foreign('id', 'lnk_permissions_permission_roles')->references('id')->on('permissions')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('role_id', 'lnk_roles_permission_roles')->references('id')->on('roles')->onUpdate('CASCADE')->onDelete('CASCADE');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_roles');

        Schema::table('permission_roles', function(Blueprint $table)
        {
            $table->dropForeign('lnk_permissions_permission_roles');
            $table->dropForeign('lnk_roles_permission_roles');
        });        
    }
}
