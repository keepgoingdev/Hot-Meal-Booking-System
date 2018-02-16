<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CondimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condiments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meal_id');
            $table->string('name');
            $table->string('serving_size');
            $table->integer('calories');
            $table->string('image');
            $table->string('notes')->nullable();
            $table->boolean('is_snack')->default(false);
            $table->string('store')->nullable();
            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condiments');
    }
}
