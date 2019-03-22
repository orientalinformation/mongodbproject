<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibraryCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table('libraries', function (Blueprint $collection) {
            $collection->index('id');
            $collection->string('name');
            $collection->string('description');
            $collection->string('image');
            $collection->string('alias');
            $collection->string('url');
            $collection->tinyInteger('view');
            $collection->double('price');
            $collection->integer('like');
            $collection->string('category_id');
            $collection->string('user_id');
            $collection->boolean('is_public');
            $collection->boolean('is_delete');
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('libraries');
    }
}
