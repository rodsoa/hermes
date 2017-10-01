<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campaign_id');
            $table->string('name');
            $table->string('path');
            $table->enum('category', ['PDF', 'AUDIO', 'IMAGE', 'VIDEO']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_files');
    }
}
