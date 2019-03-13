<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table('web', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->string('title');
            $collection->index('link');
            $collection->string('enclosure');
            $collection->text('description');
            $collection->dateTime('pub_date');
            $collection->integer('like');
            $collection->integer('view');
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
        Schema::connection('mongodb')->dropIfExists('web');
    }
}
