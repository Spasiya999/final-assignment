@extends('layouts.web.web2')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('cart.confirm', urlencode(base64_encode($order->id))) }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="first_name" id="firstName" class="form-control"
                                    value="{{ old('first_name') }}">
                                <label for="firstName">First Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="last_name" id="lastName" class="form-control"
                                    value="{{ old('last_name') }}">
                                <label for="lastName">Last Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="phone" id="phoneNumber" class="form-control"
                                    value="{{ old('phone') }}">
                                <label for="phoneNumber">Phone Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="text" name="address" id="address" class="form-control"
                                value="{{ old('address') }}">
                            <label for="address">Address</label>
                        </div>
                    </div>
                    <div class="row mb-3 d-flex">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="paymethod" id="payhere" value="payhere">
                            <label class="form-check-label" for="payhere">
                                <img src="https://www.payhere.lk/downloads/images/payhere_short_banner_dark.png" alt="payhere">
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="paymethod" id="cash" value="cash" checked>
                            <label class="form-check-label" for="cash">
                                Cash
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Checkout
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
