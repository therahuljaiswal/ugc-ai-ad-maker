<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Setting;
use App\Models\Payment;
use App\Models\User;
use App\Mail\PurchaseMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    protected $api;

    public function __construct()
    {
        $keyId = Setting::get('razorpay_key');
        $keySecret = Setting::get('razorpay_secret');
        if ($keyId && $keySecret) {
            $this->api = new Api($keyId, $keySecret);
        }
    }

    public function buyCredits()
    {
        return view('payments.buy-credits');
    }

    public function createOrder(Request $request)
    {
        $plans = [
            'starter' => ['credits' => 50, 'price' => 9],
            'pro' => ['credits' => 200, 'price' => 29],
            'expert' => ['credits' => 1000, 'price' => 99],
        ];

        $plan = $plans[$request->plan_id] ?? abort(404);

        if (!$this->api) {
            return back()->with('error', 'Razorpay not configured.');
        }

        try {
            $orderData = [
                'receipt'         => 'rcpt_' . time(),
                'amount'          => $plan['price'] * 100, // amount in paise
                'currency'        => 'INR',
            ];

            $razorpayOrder = $this->api->order->create($orderData);

            $payment = Payment::create([
                'user_id' => auth()->id(),
                'razorpay_order_id' => $razorpayOrder['id'],
                'amount' => $plan['price'],
                'credits' => $plan['credits'],
                'status' => 'pending',
            ]);

            return view('payments.checkout', [
                'order' => $razorpayOrder,
                'payment' => $payment,
                'razorpay_key' => Setting::get('razorpay_key'),
            ]);

        } catch (\Exception $e) {
            Log::error('Razorpay Order Error: ' . $e->getMessage());
            return back()->with('error', 'Could not create order: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        $input = $request->all();

        if (!$this->api) {
             return redirect()->route('dashboard')->with('error', 'Payment configuration missing.');
        }

        try {
            $attributes = [
                'razorpay_order_id' => $input['razorpay_order_id'],
                'razorpay_payment_id' => $input['razorpay_payment_id'],
                'razorpay_signature' => $input['razorpay_signature']
            ];

            $this->api->utility->verifyPaymentSignature($attributes);

            $payment = Payment::where('razorpay_order_id', $input['razorpay_order_id'])->firstOrFail();
            $payment->update([
                'razorpay_payment_id' => $input['razorpay_payment_id'],
                'status' => 'completed',
            ]);

            $user = User::find($payment->user_id);
            $user->increment('credits', $payment->credits);

            try {
                Mail::to($user->email)->send(new PurchaseMail($payment));
            } catch (\Exception $e) {
                Log::error('Purchase Email Error: ' . $e->getMessage());
            }

            return redirect()->route('dashboard')->with('success', "Payment successful! {$payment->credits} credits added.");

        } catch (\Exception $e) {
            Log::error('Razorpay Callback Error: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Payment verification failed.');
        }
    }
}
