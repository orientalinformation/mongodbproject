<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadAfterCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table('read_afters', function (Blueprint $collection) {
            $collection->index('id');
            $collection->string('object_id');
            $collection->string('user_id');
            $collection->integer('type_name');
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
        Schema::connection('mongodb')->dropIfExists('read_afters');
    }
}
