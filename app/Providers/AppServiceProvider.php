<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
//        \Braintree_Configuration::environment(config('services.braintree.environment'));
//        \Braintree_Configuration::merchantId(config('services.braintree.merchant_id'));
//        \Braintree_Configuration::publicKey(config('services.braintree.public_key'));
//        \Braintree_Configuration::privateKey(config('services.braintree.private_key'));

        if($this->app->environment() === 'local'){
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
