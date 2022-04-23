<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaborationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborations', function (Blueprint $table) {
            // $table->id();
            // $table->unsignedInteger('campaign_id');
            // // $table->unsignedInteger('collaborator_id');
            // // $table->foreign('collaborator_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('campaign_id')->references('id')->on('campaigns')->onUpdate('cascade')->onDelete('cascade');
            // $table->timestamps();

            // TODO: Need to fix
            $table->id();
            $table->unsignedInteger('campaign_id');
            $table->unsignedInteger('collaborator_id');

            $table->foreign('campaign_id')
                  ->references('id')->on('campaigns')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('collaborator_id')
                  ->references('id')->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

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
        Schema::dropIfExists('collaborations');
    }
}
