<?php

use Illuminate\Database\Seeder;

class CouponsSeeder extends Seeder
{
    /**
     * Populate active coupons to Stripe
     *
     * @return void
     */
    public function run()
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $limit = 10;
        $coupons = App\Models\DiscountCode:: where('is_activated', 0)
            ->where('code', '!=', '')
            ->with('plan')
            ->take($limit)
            ->get();

        foreach ($coupons as $coupon) {
            try {
                \Stripe\Coupon::create(array(
                    "id" => $coupon->code,
                    "name" => $coupon->name,
                    "percent_off" => 100,
                    "duration" => "repeating",
                    "duration_in_months" => $coupon->plan->month,
                    "max_redemptions" => 1
                ));
            } catch (\Exception $e) {
                echo $coupon->code . ' : ' . $e->getMessage() . "\r\n";
            }
        }

    }
}
