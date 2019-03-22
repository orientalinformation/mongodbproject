<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDetailCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table('product_details', function (Blueprint $collection) {
            $collection->index('id');
            $collection->integer('product_id');
            $collection->integer('user_id');
            $collection->boolean('share');
            $collection->boolean('pink');
            $collection->boolean('is_like');
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
        Schema::connection('mongodb')->dropIfExists('product_details');
    }
}
