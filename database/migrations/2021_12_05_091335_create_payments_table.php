<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->unsignedInteger('campaign_id');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('reward_id')->nullable();
            $table->bigInteger('amount');
            $table->string('snap_token')->nullable();
            $table->enum('status', array('pending', 'success', 'expired', 'failed'));
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
        Schema::dropIfExists('payments');
    }
}
