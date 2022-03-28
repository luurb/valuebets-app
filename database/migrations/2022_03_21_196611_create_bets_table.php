<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id', false, true);
            $table->smallInteger('bookie_id');
            $table->smallInteger('sport_id');
            $table->dateTime('date_time');
            $table->string('teams');
            $table->string('bet')->nullable();
            $table->float('odd');
            $table->float('value');
            $table->float('stake', 12, 2);
            $table->string('result')->nullable();
            $table->float('return', 21, 2)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bookie_id')->references('id')->on('bookies');
            $table->foreign('sport_id')->references('id')->on('sports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bets');
    }
};
