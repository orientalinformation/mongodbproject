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
            $collection->string('title');
            $collection->string('alias');
            $collection->integer('share');
            $collection->integer('view');
            $collection->boolean('is_public');
            $collection->boolean('is_video');
            $collection->boolean('is_image');
            $collection->boolean('is_sound');
            $collection->string('description');
            $collection->string('image');
            $collection->string('url');
            $collection->double('price');
            $collection->integer('like');
            $collection->string('category_id');
            $collection->integer('user_id');
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
