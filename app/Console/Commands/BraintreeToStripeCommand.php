<?php

namespace App\Console\Commands;

use App\Plan;
use App\Subscription;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BraintreeToStripeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:stripe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $content = \File::get(storage_path('braintree_to_stripe.json'));

        $content = json_decode($content, true);
        foreach ($content as $braintreeId => $data) {
            $user = User::where('braintree_id', $braintreeId)
                ->first();
            if ($user) {
                //$user->stripe_id = $data['id'];
                $user->stripe_id = 'cus_Cr2lZCZazNPikC';
                $user->save();

                /** @var \Laravel\Cashier\Subscription|Subscription $subscription */
                $oldSubscription = $user->subscription('main');

                $plan = Plan::where('braintree_plan', $oldSubscription->stripe_plan ?: $oldSubscription->braintree_plan)->first();
                $trialUntil = (new Carbon($oldSubscription->created_at))->addMonth($plan->month);
                if (!$oldSubscription->ends_at) {

                    $subscription = $user->newSubscription('main', $plan->brantree_plan ?: $plan->stripe_plan);

                    /** @var Carbon $createdAt */
                    $createdAt = $oldSubscription->created_at;

                    $subscription->trialUntil($trialUntil);
                    $subscription = $subscription->create(null, [
                        'created' => $createdAt->getTimestamp(),
                    ]);
                    $subscription->created_at = $createdAt;
                    $subscription->save();
                } else {

                }
            }
        }

        //\DB::statement('UPDATE subscriptions SET stripe_plan = braintree_plan');
    }
}
