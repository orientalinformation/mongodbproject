<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD
//        Schema::connection('mongodb')->table('categories', function (Blueprint $collection) {
//            $collection->index('id');
//            $collection->string('name');
//            $collection->string('alias');
//            $collection->string('description');
//            $collection->string('parentID');
//            $collection->string('path');
//            $collection->timestamps();
//
//        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('alias');
            $table->string('description');
            $table->integer('parent_id')->nullable();
            $table->string('path')->nullable();
            $table->timestamps();
=======
        Schema::connection('mongodb')->table('categories', function (Blueprint $collection) {
            $collection->index('id');
            $collection->string('name');
            $collection->string('alias');
            $collection->string('description');
            $collection->string('parent_id');
            $collection->string('path');
            $collection->timestamps();
>>>>>>> 715ec36924ea6f35ac67673681f3534020d181e1

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('categories');
    }
}
