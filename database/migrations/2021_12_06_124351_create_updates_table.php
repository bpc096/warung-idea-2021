<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('updates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('users_id')->nullable();
            $table->unsignedInteger('campaign_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            // $table->foreign('campaign_id')
            //       ->references('id')->on('campaigns')
            //       ->onUpdate('cascade')
            //       ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('updates');
    }
}
