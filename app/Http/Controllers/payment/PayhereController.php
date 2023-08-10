<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayhereController extends Controller
{
    public function pay($orderId){
        $order = new Order();
        $order = $order->getOrder(base64_decode(urldecode($orderId)));
        $checkoutData = json_decode($order->checkout_data);
        $title = 'Order Confirm';

        $hash = strtoupper(
            md5(
                env('PAYHERE_MERCHANT_ID') .
                $order->id .
                number_format($order->total,2, '.', '') .
                'LKR' .
                strtoupper(md5(env('PAYHERE_SECRET')))
            )
        );

        return view('home.payment.payhere.pay', compact('order', 'checkoutData', 'hash', 'title'));
    }

    public function return($orderId){
        // $order = new Order();
        // $order = $order->getOrder(base64_decode(urldecode($orderId)));

        echo 'Payment Successfull';
    }

    public function cancel($orderId){
        // $order = new Order();
        // $order = $order->getOrder(base64_decode(urldecode($orderId)));

        echo 'Payment Cancelled';
    }

    public function notify(Request $request){
        Log::debug('request to noyify'.json_encode($request->all(),JSON_PRETTY_PRINT));

        $orderId = $request->order_id;
        $order = Order::find($orderId);

        if($order && $order->payment_status == 'pending'){

            $local_md5sig = strtoupper(
                md5(
                    env('PAYHERE_MERCHANT_ID') .
                    $orderId .
                    $request->payhere_amount .
                    $request->payhere_currency .
                    $request->status_code .
                    strtoupper(md5(env('PAYHERE_SECRET')))
                )
            );
            // Log::debug('local md5sig: '.$local_md5sig);
            dd($local_md5sig);

            if($local_md5sig == $request->md5sig && $request->status_code == 2){

                $payment_meta = [];

                if($order->payment_meta){
                    $payment_meta[] = json_decode($order->payment_meta);
                    $payment_meta[] = $request->all();
                }else{
                    $payment_meta[] = $request->all();
                }

                if($order->update([
                    'payment_status' => 'paid',
                    'payment_id' => $request->payment_id ,
                    'payment_meta' => json_encode($payment_meta),
                ])){
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Payment Successfull',
                    ]);
                }
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Payment Failed',
        ]);
    }
}
