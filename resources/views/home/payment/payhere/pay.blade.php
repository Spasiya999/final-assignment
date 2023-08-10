@extends('layouts.web.web2')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="mt-3">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Payhere Payment</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Order ID: {{ $order->id }}</strong>
                                </div>
                                <span><strong>Total: LKR.{{ $order->total }}</strong></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <form class="" method="post" action="{{ env('PAYHERE_ENDPOINT') }}">
            <input type="hidden" name="merchant_id" value="{{ env('PAYHERE_MERCHANT_ID') }}">

            <input type="hidden" name="return_url" value="http://sample.com/return">
            <input type="hidden" name="cancel_url" value="http://sample.com/cancel">
            <input type="hidden" name="notify_url" value="http://sample.com/notify">

            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <input type="hidden" name="items" value="Order {{ $order->id }}">
            <input type="hidden" name="currency" value="LKR">
            <input type="hidden" name="amount" value="{{ number_format($order->total, 2, '.', '') }}">

            <input type="hidden" name="first_name" value="{{ $checkoutData->first_name ?? '' }}">
            <input type="hidden" name="last_name" value="{{ $checkoutData->last_name ?? '' }}">
            <input type="hidden" name="email" value="{{ $checkoutData->email ?? '' }}">
            <input type="hidden" name="phone" value="{{ $checkoutData->phone ?? '' }}">
            <input type="hidden" name="address" value="{{ $checkoutData->address ?? '' }}">
            <input type="hidden" name="city" value="Colombo">
            <input type="hidden" name="country" value="Sri Lanka">
            <input type="hidden" name="hash" value="{{ $hash }}"> <!-- Replace with generated hash -->
            <input type="submit" class="btn btn-primary" value="Pay Now">
        </form>
    </div>
</div>
@endsection
