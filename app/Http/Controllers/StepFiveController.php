<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use App\Plan;
use Braintree_ClientToken;
use Illuminate\Http\Request;
use Stripe\Coupon;
use Stripe\Stripe;

class StepFiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function index(Request $request)
    {
        $discount = false;

        $plans = Plan::where('is_discount', false)
            ->orderBy('month')
            ->get();

        $selectedPlan = $request->query->get('plan') ?? $plans->last()->id;

        return view('steps.step5')->with([
            'thehotmealPlans' => $plans,
            'selectedPlan' => $selectedPlan,
            'discount' => $discount,
        ]);
    }

    public function validateCoupon(Request $request)
    {

        $code = $request->input('coupon-code');

        $discount = DiscountCode::validateCode($code);

        if (is_null($discount) || $discount->is_activated) {
            return response()->json(false);
        }
        $plan = $discount->plan()->first();
        if (is_null($plan)) {
            return response()->json(false);
        }
        $planName = $plan->name;
        $price = $plan->cost;
        $planId = $plan->id;

        // Check coupon code on Stripe side
        $coupon = null;
        try {
            $coupon = Coupon::retrieve($code);
        } catch (\Exception $e) {
            return response()->json(false);
        }

        if ($coupon) {
            $price = number_format($price - $price * $coupon->percent_off / 100, 2, '.', '');
            $planName .= ' Discount';
        }

        return response()->json([
            'discount' => $discount,
            'planId' => $planId,
            'planName' => $planName,
            'price' => $price,
            'coupon' => $coupon->id
        ]);
    }
}
