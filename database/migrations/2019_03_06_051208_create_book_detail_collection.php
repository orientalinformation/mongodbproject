<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookDetailCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table('book_details', function (Blueprint $collection) {
            $collection->index('id');
            $collection->string('book_id');
            $collection->string('user_id');
            $collection->boolean('share');
            $collection->boolean('pink');
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
        Schema::connection('mongodb')->dropIfExists('book_details');
    }
}
