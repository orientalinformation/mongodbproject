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
            $collection->index('url');
            $collection->string('image');
            $collection->text('description');
            $collection->dateTime('pubDate');
            $collection->smallInteger('status');  // 0: old, 1: new, 2: update
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
