<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table('books', function (Blueprint $collection) {
            $collection->index('id');
            $collection->string('title');
            $collection->string('alias');
            $collection->string('author');
            $collection->string('type');
            $collection->string('description');
            $collection->string('image');
            $collection->string('file');
            $collection->double('price');
            $collection->integer('status');
            $collection->integer('share');
            $collection->string('cat_id');
            $collection->integer('view');
            $collection->integer('like');
            $collection->boolean('is_public');
            $collection->boolean('is_video');
            $collection->boolean('is_image');
            $collection->boolean('is_sound');
            $collection->boolean('is_delete');
            $collection->integer('user_id');
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
        Schema::connection('mongodb')->dropIfExists('books');
    }
}
