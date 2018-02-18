<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyWeekPlanAgain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_additional', function(Blueprint $table) {
            $table->integer('week_plan_id');
            $table->integer('day');
            $table->integer('exercise')->default(0);
            $table->integer('additional')->default(0);
            $table->integer('completed_sum')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_additional');
    }
}
