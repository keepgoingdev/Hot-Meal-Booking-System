<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Braintree_Plan;
use App\Plan;

class SyncPlans extends Command
{
    protected $signature = 'braintree:sync-plans';
    protected $description = 'Sync with online plans on Braintree';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Empty table
        Plan::truncate();

        // Get plans from Braintree
        $braintreePlans = Braintree_Plan::all();

        // Iterate through the plans while populating our table with the plan data
        foreach ($braintreePlans as $braintreePlan) {
            $discount = strpos( $braintreePlan->name, 'discounted') != false;
            Plan::create([
                'name' => $braintreePlan->name,
                'slug' => str_slug($braintreePlan->name),
                'braintree_plan' => $braintreePlan->id,
                'cost' => $braintreePlan->price,
                'description' => $braintreePlan->description,
                'is_discount' => $discount
            ]);
        }
    }
}
