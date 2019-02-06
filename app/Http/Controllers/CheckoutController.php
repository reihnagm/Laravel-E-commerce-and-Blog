<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;

use Toastr;

use Braintree\Gateway as paypalService;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderProduct;

use Gloudemans\Shoppingcart\Facades\Cart;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    public function index()
    {
        $gateway = new paypalService([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        // ALLOW GUEST CHECKOUT
        if (auth()->user() && request()->is('guestCheckout')) {
            return redirect(route('checkout.index'));
        }

        try {
            $paypalToken = $gateway->ClientToken()->generate();
        } catch (\Exception $e) {
            $paypalToken = null;
        }

        return view('checkout.index')->with([
            'paypalToken' => $paypalToken,
            'discount' => getNumbers()->get('discount'),
            'guestDiscount' => getNumbers()->get('guestDiscount'),

            'newSubtotal' => getNumbers()->get('newSubtotal'),
            'newTax' => getNumbers()->get('newTax'),
            'newTotal' => getNumbers()->get('newTotal'),

            'guestNewSubTotal' => getNumbers()->get('guestNewSubTotal'),
            'guestNewTax' => getNumbers()->get('guestNewTax'),
            'guestNewTotal' => getNumbers()->get('guestNewTotal'),
        ]);
    }

    public function store(CheckoutRequest $request)
    {
        $contents = Cart::content()->map(function ($item) {
            return $item->name.' '.$item->qty;
        })->values()->toJson();

        $amount = auth()->check() ? getNumbers()->get('newTotal') : getNumbers()->get('guestNewTotal');



        try {
            $charge = Stripe::charges()->create([
                'amount' => $amount,
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);

            session()->forget('coupon');


            $order = $this->addToOrdersTables($request, null);
        } catch (CardErrorException $e) {
            Toastr::info($e->getMessage());
            return back();
        }
    }

    public function paypalCheckout(Request $request)
    {
        $gateway = new paypalService([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $nonce = $request->payment_method_nonce;

        $amount = auth()->check() ? getNumbers()->get('newTotal') : getNumbers()->get('guestNewTotal');

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        $transaction = $result->transaction;

        if ($result->success) {
            Cart::instance('default')->destroy();

            session()->forget('coupon');
        } else {
            Toastr::info('An error occurred with the message: '.$result->message);

            return back();
        }
    }

    protected function addToOrdersTables($request, $error)
    {
        $subTotal = auth()->check() ? getNumbers()->get('newSubtotal') : getNumbers()->get('guestNewSubTotal');

        $tax = auth()->check() ? getNumbers()->get('newTax') :  getNumbers()->get('guestNewTax');
        $newTotal = auth()->check() ? getNumbers()->get('newTotal') :  getNumbers()->get('guestNewTotal');

        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' =>  getNumbers()->get('discount'),
            'billing_discount_code' => getNumbers()->get('code'),
            'billing_subtotal' => $subTotal,
            'billing_tax' => $tax,
            'billing_total' => $newTotal,
            'error' => $error,
        ]);

        if (auth()->user()) {
            Cart::instance('default')->destroy();
        } else {
            Cart::instance('guest')->destroy();
        }

        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        return $order;
    }
}
