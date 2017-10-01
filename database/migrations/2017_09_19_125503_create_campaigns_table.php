<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('campaign_number_list_id');
            $table->string('name', 80);
            $table->text('message')->nullable();
            $table->enum('type', ['TXT', 'ITXT', 'VTXT', 'PDF', 'AUDIO']);
            $table->date('date');
            $table->enum('status', ['W', 'S', 'C', 'D'])->default('W')->comment('Waiting to start | Started | Completed | Denied');
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
        Schema::dropIfExists('campaigns');
    }
}
