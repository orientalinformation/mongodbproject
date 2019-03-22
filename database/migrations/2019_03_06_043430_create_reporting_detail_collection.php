<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportingDetailCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table('reporting_details', function (Blueprint $collection) {
            $collection->index('id');
            $collection->string('reporting_id');
            $collection->string('user_id');
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
        Schema::connection('mongodb')->dropIfExists('reporting_details');
    }
}
