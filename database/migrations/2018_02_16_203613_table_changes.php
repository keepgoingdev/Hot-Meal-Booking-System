<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableChanges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('confirmed');
        });
        Schema::table('meals', function (Blueprint $table) {
            $table->boolean('is_enabled')->default(true)->after('is_snack');
        });
        Schema::table('week_plans', function (Blueprint $table) {
            $table->integer('calory_goal');
            $table->integer('weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
