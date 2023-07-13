<div class="card rounded shadow mt-3">
    <div class="row g-2">
        <div class="col-md-6">
            <img class="rounded w-100" src="{{$room->image ? asset('storage/'.$room->image) : 'img/room/placeholder-image.png'}}" alt="">
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <div class="card-title text-center rounded">
                    <h2>{{ $room->room_name }}</h2>
                </div>
                <p class="short-description">{{$room->short_description}}</p>
                <div class="row d-flex align-items-center">
                    <div class="col-md-6">
                        Beds: {{$room->beds}} <br>
                        Max Occupancy: {{$room->occupancy}}
                    </div>
                    <div class="col-md-6 text-end">
                        <h5 class="me-auto">Price: {{$room->price}}</h5>
                    </div>
                </div>
                <div class="row" style="margin-top: 100px">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="bookingBtn rounded-3">
                            <a href="{{ route('room.inside', $room->id) }}" class="btn btn-warning w-100">Select Room</a>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="social-media-link">
                    <div class="row mt-4">
                        <div class="col-md-4 text-center"><i style="font-size: 2rem" class="fa-brands fa-facebook"></i></div>
                        <div class="col-md-4 text-center"><i style="font-size: 2rem" class="fa-brands fa-instagram"></i></div>
                        <div class="col-md-4 text-center"><i style="font-size: 2rem" class="fa-brands fa-twitter"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
