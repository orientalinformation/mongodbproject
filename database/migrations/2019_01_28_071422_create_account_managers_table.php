<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_managers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->tinyInteger('access_documents')->nullable();
            $table->boolean('customizable_curation')->nullable();
            $table->tinyInteger('number_rss')->nullable();
            $table->tinyInteger('customizing_environment')->nullable();
            $table->tinyInteger('number_libraries')->nullable();
            $table->boolean('follow_discussion_groups')->nullable();
            $table->string('participation_disussions')->nullable();
            $table->string('creating_disussion')->nullable();
            $table->boolean('publicity')->nullable();
            $table->boolean('association_applications')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('account_id')->unsigned()->nullable()->index('lnk_account_managers_users');
            $table->foreign('account_id', 'lnk_account_managers_users')->references('id')->on('account_managers')->onUpdate('CASCADE')->onDelete('CASCADE');
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
            $table->dropForeign('lnk_account_managers_users');
            $table->dropIndex('lnk_account_managers_users');
        });
        
        Schema::dropIfExists('account_managers');
    }
}
