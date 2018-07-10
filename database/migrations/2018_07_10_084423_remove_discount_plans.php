<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveDiscountPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::update('UPDATE discount_codes SET plan_id = plan_id - 1');
        \DB::delete('DELETE FROM plans WHERE cost = 0');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::update('UPDATE discount_codes SET plan_id = plan_id + 1');
    }
}
