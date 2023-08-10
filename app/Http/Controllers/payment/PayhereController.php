<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayhereController extends Controller
{
    /**
     * Display the payment page for the given order ID.
     *
     * @param  string  $orderId  The encoded order ID.
     * @return \Illuminate\Contracts\View\View  The view for the payment page.
     */
    public function pay($orderId){
        $order = new Order();
        $order = $order->getOrder(base64_decode(urldecode($orderId)));
        $checkoutData = json_decode($order->checkout_data);
        $title = 'Order Confirm';

        $hash = strtoupper(
            md5(
                env('PAYHERE_MERCHANT_ID') .
                $order->id .
                number_format($order->total, 2, '.', '') .
                'LKR' .
                strtoupper(md5(env('PAYHERE_SECRET')))
            )
        );

        return view('home.payment.payhere.pay', compact('order', 'checkoutData', 'hash', 'title'));
    }

    /**
     * Handle the return from the payment gateway for a successful payment.
     *
     * @param  string  $orderId  The encoded order ID.
     * @return string  A success message.
     */
    public function return($orderId){
        echo 'Payment Successful';
    }

    /**
     * Handle the return from the payment gateway for a cancelled payment.
     *
     * @param  string  $orderId  The encoded order ID.
     * @return string  A cancellation message.
     */
    public function cancel($orderId){
        echo 'Payment Cancelled';
    }

    /**
     * Handle the payment gateway's notification callback.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing the notification data.
     * @return \Illuminate\Http\JsonResponse  A JSON response indicating the status of the notification processing.
     */
    public function notify(Request $request){
        Log::debug('request to notify: ' . json_encode($request->all(), JSON_PRETTY_PRINT));

        $orderId = $request->order_id;
        $order = Order::find($orderId);

        if ($order && $order->payment_status == 'pending') {
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

            if ($local_md5sig == $request->md5sig && $request->status_code == 2) {
                $payment_meta = [];

                if ($order->payment_meta) {
                    $payment_meta[] = json_decode($order->payment_meta);
                    $payment_meta[] = $request->all();
                } else {
                    $payment_meta[] = $request->all();
                }

                if ($order->update([
                    'payment_status' => 'paid',
                    'payment_id' => $request->payment_id,
                    'payment_meta' => json_encode($payment_meta),
                ])) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Payment Successful',
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
