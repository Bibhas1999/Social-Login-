<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Payment;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function view($id)
    {   
        $user = User::find($id);
        return view('payment',compact('user'));
    }

    public function store(Request $request)
    {   
        $name = $request->name;
        $amount = $request->amount;
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $order = $api->order->create(array(
            'receipt' => '123',
            'amount' => $amount * 100,
            'currency' => 'INR'
        ));

        $orderId = $order['id'];

        $payment = new Payment();
        $payment->name = $name;
        $payment->amount = $amount;
        $payment->user_id = $request->user_id;
        $payment->payment_id = $orderId;
        $payment->save();
        Session::put('order_id',$orderId);
        Session::put('amount',$amount);
         
        return redirect()->back();

    }

    public function pay(Request $request)
    {
        $data = $request->all();
        $user = Payment::where('payment_id',$data['razorpay_order_id'])->first();
        $user->payment_done = true; 
        $user->razorpay_id = $data['razorpay_order_id'];
        $user->save();
        return redirect()->route('success');
    }

    public function success()
    {
        return view('success');
    }
}
