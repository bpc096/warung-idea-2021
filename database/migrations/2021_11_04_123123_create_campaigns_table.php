<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id')->unsigned();
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('category_id');
            $table->string('title');
            $table->string('slug');
            $table->string('short_description');
            $table->bigInteger('target_donation');
            $table->date('max_date');
            $table->string('image');
            $table->text('description');
            $table->text('project_plan');
            $table->json('collaborators');
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
        Schema::dropIfExists('project');
    }
}
