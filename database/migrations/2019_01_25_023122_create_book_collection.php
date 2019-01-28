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
            $collection->string('shortDescription');
            $collection->string('description');
            $collection->string('image');
            $collection->string('file');
            $collection->double('price');
            $collection->integer('status');
            $collection->integer('share');
            $collection->string('catID');
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
