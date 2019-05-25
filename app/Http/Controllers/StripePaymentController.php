<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Shipping;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
       $grand_total = $request->grand_total;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * $grand_total,
                "currency" => "bdt",
                "source" => $request->stripeToken,
                "description" => "Our Ecommerce"
        ]);
        Shipping::find($request->shipping_id)->update([
          'pament_status' => 2
        ]);
        Session::flash('success', 'Payment successful!');

        return redirect('cart');
    }
}
