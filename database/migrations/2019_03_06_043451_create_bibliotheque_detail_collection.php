<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBibliothequeDetailCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table('bibliotheque_details', function (Blueprint $collection) {
            $collection->index('id');
            $collection->string('bibliotheque_id');
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
        Schema::connection('mongodb')->dropIfExists('bibliotheque_details');
    }
}
