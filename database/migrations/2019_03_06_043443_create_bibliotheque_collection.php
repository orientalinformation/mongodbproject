<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBibliothequeCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table('bibliotheques', function (Blueprint $collection) {
            $collection->index('id');
            $collection->string('title');
            $collection->string('description');
            $collection->string('image');
            $collection->string('url');
            $collection->tinyInteger('view');
            $collection->double('price');
            $collection->integer('like');
            $collection->string('category_id');
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
        Schema::connection('mongodb')->dropIfExists('bibliotheques');
    }
}
