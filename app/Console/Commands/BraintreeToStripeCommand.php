<?php

namespace App\Console\Commands;

use App\Subscription;
use App\User;
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
        foreach($content as $braintreeId => $data){
            $user = User::where('braintree_id', $braintreeId)
                ->first();
            if($user){
                $user->stripe_id = $data['id'];
                $user->save();
            }
        }

        \DB::statement('UPDATE subscriptions SET stripe_plan = braintree_plan');
    }
}
