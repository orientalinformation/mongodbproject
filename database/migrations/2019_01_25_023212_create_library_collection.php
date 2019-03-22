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
            $collection->double('price');
            $collection->integer('like');
            $collection->string('category_id');
            $collection->string('user_id');
            $collection->integer('view');
            $collection->boolean('is_public');
            $collection->boolean('is_video');
            $collection->boolean('is_image');
            $collection->boolean('is_sound');
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
