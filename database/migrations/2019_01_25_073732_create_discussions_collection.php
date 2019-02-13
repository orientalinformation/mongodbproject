<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionsCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table('discussions', function (Blueprint $collection) {
            $collection->index('id');
            $collection->string('title');
            $collection->string('type');
            $collection->string('moderator');
            $collection->dateTime('start');
            $collection->dateTime('end');
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
        Schema::connection('mongodb')->dropIfExists('discussions');
    }
}
