<h3>{{$room->room_name}}</h3>
<input type="hidden" name="room_name" value="{{$room->room_name}}">
<div class="row">
    <div class="col-md-9">
        <img class="rounded w-100" src="{{ $room->image ? Storage::url($room->image) : asset('img/room/placeholder-image.png') }}">
    </div>
    <div class="col-md-3">
        <div class="form rounded border p-2">
            <form method="POST" action="{{route('booking.create')}}">
                @csrf
                <h3 class="text-center">BOOK YOUR ROOM</h3>
                <input type="hidden" name="room_id" value="{{$room->id}}">
                <input type="hidden" name="room_name" value="{{$room->room_name}}">
                <input type="hidden" name="room_number" value="{{$room->room_number}}">
                {{-- <fieldset disabled> --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                        {{-- value="{{ $bookingData['booking_name'] }}" --}}
                        >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email Address</label>
                        <input type="email" class="form-control" name="email" id="email"
                        {{-- value="{{ $bookingData['booking_name'] }}" --}}
                        >
                    </div>
                    <div class="mb-3">
                        <label for="roomType" class="form-label">Room Type</label>
                        <input type="text" id="roomType" class="form-control" placeholder="{{ $room->room_type }}">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="date">Date:- Check In</label>
                        <input type="date" class="form-control" name="dateCheckIn" id="date" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="date">Date:- Check Out</label>
                        <input type="date" class="form-control" name="dateCheckOut" id="date" placeholder="">
                    </div> --}}
                    <div class="mb-3">
                        <label for="guest">Guests</label>
                        <input type="text" class="form-control" name="guest" id="guest" placeholder="">
                    </div>
                {{-- </fieldset> --}}
                <div class="mb-3">
                    <button type="submit" class="btn text-center w-100" style="background-color: #FEA116; color:black">BOOK THIS ROOM</button>
                </div>
            </form>
        </div>
        <div class="social-media-link mt-2 border rounded p-2">
            <div class="row">
                <div class="col-md-4 text-center"><i style="font-size: 2rem" class="fa-brands fa-facebook"></i></div>
                <div class="col-md-4 text-center"><i style="font-size: 2rem" class="fa-brands fa-instagram"></i></div>
                <div class="col-md-4 text-center"><i style="font-size: 2rem" class="fa-brands fa-twitter"></i></div>
            </div>
        </div>
        <div class="social-media-link mt-2 border rounded p-2">
            <a href="#" class="text-center"><h3>Contact Us</h3></a>
        </div>
    </div>
</div>
<div class="row mt-2">
    <h4>{{$room->room_number}}</h4>
    <input type="hidden" name="room_number" value="{{$room->room_number}}">
    <div class="col-md-12">
        <p>
            {{$room->short_description}}
        </p>
        <p class="mt-2">
            {{$room->description}}
        </p>
        <div class="row">
            <div class="col-md-4">
                <p class="mt-2 p-2 border text-center">
                    <i class="fa-solid fa-bed mx-1"></i> {{$room->beds}}
                </p>
            </div>
            <div class="col-md-4">
                <p class="mt-2 p-2 border text-center">
                    <i class="fa-solid fa-users mx-1"></i> {{$room->occupancy}}
                </p>
            </div>
            <div class="col-md-4">
                <p class="mt-2 p-2 border text-center">
                    <i class="fa-solid fa-dollar-sign mx-1"></i> {{$room->price}}
                </p>
            </div>
        </div>
    </div>
</div>

