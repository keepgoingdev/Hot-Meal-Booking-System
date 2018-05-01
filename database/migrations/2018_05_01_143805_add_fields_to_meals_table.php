<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meals', function(Blueprint $table) {
            $table->boolean('is_breakfast')->default(true)->after('is_snack');
            $table->boolean('is_lunch')->default(true)->after('is_breakfast');
            $table->boolean('is_dinner')->default(true)->after('is_lunch');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meals', function(Blueprint $table) {
            $table->dropColumn('is_breakfast');
            $table->dropColumn('is_lunch');
            $table->dropColumn('is_dinner');
        });
    }
}
