<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStripeToRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('stripe_id')->after('braintree_id')->nullable();
        });

        Schema::table('subscriptions', function ($table) {
            $table->string('braintree_id')->nullable()->change();
            $table->string('braintree_plan')->nullable()->change();
            $table->string('stripe_id')->after('braintree_plan')->nullable();
            $table->string('stripe_plan')->after('stripe_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('subscriptions', function ($table) {
            $table->dropColumn('stripe_id');
            $table->dropColumn('stripe_plan');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('stripe_id');
        });
    }
}
