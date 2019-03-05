<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table('products', function (Blueprint $collection) {
            $collection->index('id');
            $collection->string('title');
            $collection->string('alias');
            $collection->string('shortDescription');
            $collection->string('description');
            $collection->string('image');
            $collection->double('price');
            $collection->integer('views');
            $collection->integer('ans');
            $collection->integer('like');
            $collection->string('catID');
            $collection->bigInteger('userId');
            $collection->boolean('status');
            $collection->boolean('share');
            $collection->boolean('readAfter');
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
        Schema::connection('mongodb')->dropIfExists('products');
    }
}
