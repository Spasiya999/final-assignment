@extends('layouts.web.web2')
@section('content')
    <div class="container">
        <form action="{{route('order.confirm')}}" method="post">
            @csrf
            <input type="hidden" name="booking_id" value="{{$booking->id}}">
            <input type="hidden" name="title" value="Select Your Room">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="order_name" id="name" value="{{$bookingData['booking_name']}}" placeholder="Your Name">
                        <label for="name">Your Name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="email" class="form-control" name="order_email" id="email" value="{{$bookingData['booking_email']}}" placeholder="Your Email">
                        <label for="email">Your Email</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="order_phoneNumber" id="phoneNumber" placeholder="phoneNumber">
                        <label for="phoneNumber">Phone Number</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="order_address" id="address"
                            placeholder="address">
                        <label for="address">Address</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                        <textarea class="form-control" name="order_comment" id="comment"
                            placeholder="Commnets" rows="3"></textarea>
                        <label for="address">Comments</label>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <h3 class="text-center">
                        Room Details
                    </h3>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="order_roomName" id="roomName"
                            placeholder="" value="{{$room->room_name}}">
                        <label for="roomName">Room Name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="order_roomType" id="roomType"
                            placeholder="" value="{{$room->room_type}}">
                        <label for="roomType">Room Type</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="order_roomNumber" id="roomNumber" placeholder="" value="{{$room->room_number}}">
                    <label for="roomNumber">Room Number</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="order_roomBeds" id="roomBeds" placeholder="" value="{{$room->beds}}">
                            <label for="beds">Beds</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="order_guest" id="guest" placeholder="" value="{{$bookingData['booking_guest']}}">
                            <label for="roomNumber">Guests</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary w-100 py-3" type="submit">Place Order</button>
                </div>
            </div>
        </form>
    </div>
@endsection
