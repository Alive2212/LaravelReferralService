<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alive_referral_processes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class')->nullable();
            $table->string('method')->nullable();
            $table->string('params')->nullable();
            $table->integer('rule_id')->unsigned();
            $table->foreign('rule_id')
                ->references('id')
                ->on('alive_referral_rules')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('processes');
    }
}
