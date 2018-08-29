<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAliveReferralRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alive_referral_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class')->nullable();
            $table->string('method')->nullable();
            $table->string('user_id')->nullable();
            $table->string('rules')->nullable();
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
        Schema::dropIfExists('alive_referral_rules');
    }
}
