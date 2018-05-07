<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FoodTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('serving_size')->nullable();
            $table->integer('calories')->nullable();
            $table->string('image')->nullable();
            $table->string('notes')->nullable();
            $table->boolean('is_snack')->default(false);
            $table->string('store')->nullable();
        });

        Schema::create('user_favorite_meals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('meal_id');
        });

        Schema::create('week_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->date('start_date');
            $table->date('end_date');

            $table->index('user_id');
        });

        Schema::create('day_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('week_plan_id');
            $table->integer('day');
            $table->integer('meal_id');
            $table->string('time_of_day');
            $table->boolean('meal_completed')->default(0);

            $table->index('week_plan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
        Schema::dropIfExists('user_favorite_meals');
        Schema::dropIfExists('week_plans');
        Schema::dropIfExists('day_menus');
        Schema::dropIfExists('day_menu_meal');
    }
}
