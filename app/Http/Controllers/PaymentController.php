<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Your logic for displaying payment information goes here
        return view('payment.index');
    }

    public function checkout() {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items' =>[
                [
                    'price_data'=> [
                        'currency' => 'gbp',
                        'product_data' => [
                            'name' => 'Send me money!!!',
                        ],
                        'unit_amount' => 500, //$5.00
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment'),
        ]);
        return redirect()->away($session->url);
    }

    public function success(){
        return view('payment.index');
    }
}
