<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMonthToPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->integer('month')->nullable()->unsigned()->after('name');
            $table->boolean('show_on_homepage')->default(false)->after('is_discount');
            $table->string('homepage_name')->after('name')->nullable();
        });

        \DB::table('plans')->where('is_discount', false)->update(['show_on_homepage' => true]);

        \DB::table('plans')->where('slug', 'LIKE', '%one-month%')->update(['month' => 1, 'homepage_name' => 'STARTER']);
        \DB::table('plans')->where('slug', 'LIKE', '%one-month%')
            ->where('cost', '>', 0)
            ->update(['cost' => 15]);
        \DB::table('plans')->where('slug', 'LIKE', '%three-months%')->update(['month' => 3, 'homepage_name' => 'PREMIUM']);
        \DB::table('plans')->where('slug', 'LIKE', '%three-months%')
            ->where('cost', '>', 0)
            ->update(['cost' => 23.85]);

        \DB::table('plans')->where('slug', 'LIKE', '%six-months%')->update(['month' => 6, 'show_on_homepage' => false]);
        \DB::table('plans')->where('slug', 'LIKE', '%six-months%')
            ->where('cost', '>', 0)
            ->update(['cost' => 41.7]);

        \DB::table('plans')->where('slug', 'LIKE', '%twelve-months%')->update(['month' => 12, 'homepage_name' => 'RECOMMENDED']);
        \DB::table('plans')->where('slug', 'LIKE', '%twelve-months%')
            ->where('cost', '>', 0)
            ->update(['cost' => 59.4]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn('homepage_name');
            $table->dropColumn('show_on_homepage');
            $table->dropColumn('month');
        });
    }
}
