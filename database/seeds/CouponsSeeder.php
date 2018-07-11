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

        $limit_per_month = 4;
        $months_list = [1, 3, 6, 12];

        // Delete all current coupons
        $coupons = \Stripe\Coupon::all(["limit" => 100]);
        foreach ($coupons->data as $coupon) {
            echo $coupon->id . " deleted \r\n";
            $coupon->delete();
        }

        foreach ($months_list as $months) {

            $coupons = \DB::table('discount_codes')
                ->join('plans', 'discount_codes.plan_id', '=', 'plans.id')
                ->select('code', 'discount_codes.name', 'plans.month as months_amount')
                ->where('plans.month', '=', $months)
                ->take($limit_per_month)
                ->get();

            foreach ($coupons as $coupon) {
                echo $coupon->code . "-" . $coupon->months_amount . '-' . $coupon->name . "\r\n";
                try {
                    $coupon = \Stripe\Coupon::create(array(
                        "id" => $coupon->code,
                        "name" => $coupon->name,
                        "percent_off" => 100,
                        "duration" => "repeating",
                        "duration_in_months" => $coupon->months_amount,
                        "max_redemptions" => 1
                    ));
                    echo $coupon->id . " created \r\n";
                } catch (\Exception $e) {
                    echo $coupon->code . ' : ' . $e->getMessage() . "\r\n";
                }
            }

        }

    }
}
