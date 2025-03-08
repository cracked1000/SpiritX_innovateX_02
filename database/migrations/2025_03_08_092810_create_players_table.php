<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('university');
            $table->string('category');
            $table->integer('total_runs')->default(0);
            $table->integer('balls_faced')->default(0);
            $table->integer('innings_played')->default(0);
            $table->integer('wickets')->default(0);
            $table->float('overs_bowled')->default(0);
            $table->integer('runs_conceded')->default(0);
            $table->decimal('points', 10, 2)->nullable();
            $table->decimal('value', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('players');
    }
}