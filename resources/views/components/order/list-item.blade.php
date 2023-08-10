<?php
$booking = $item->booking;
$room = $booking->room;
?>
<div class="card rounded shadow mt-3 cart-item" id="cart-item-{{$item->id}}" style="position: relative;">
    <div class="row g-2">
        <div class="col-md-6">
            <img class="rounded w-100" src="{{ $room->image ? asset('storage/' . $room->image) : 'img/room/placeholder-image.png' }}" alt="">
        </div>
        <div class="col-md-6">
            <div class="card-body mr-2">
                <div class="card-title text-center rounded">
                    <h2>{{ $room->room_name }}</h2>
                </div>
                <div class="card-title text-center rounded">
                    <h4><a href="{{ route('room.inside', $room->id) }}" style="color: #000;">{{ $item->item_name }}</a></h4>
                </div>
                <p class="short-description">{{ $room->short_description }}</p>
                <div class="row d-flex align-items-center">
                    <div class="col-md-12">
                        Beds: {{ $room->beds }} <br>
                        Guest: {{ $room->occupancy }}
                    </div>
                </div>
                <br>
                <div class="col-md-6">
                    <h5 class="" style="color: #FEA116;">Price: {{ $item->amount }}</h5>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="items[]" value="{{$item->id}}">
    <button type="button" class="cart-item-remove" data-item="{{$item->id}}" style="position: absolute; top: -8px; right: -8px; background-color: red; border: none; padding: 5px; font-size: 1rem; color: white; cursor: pointer; border-radius: 50%; width: 30px; height: 30px;"><i class="fa-solid fa-trash"></i></button>
</div>

<script>
    $(document).ready(function () {
        $('.cart-item-remove').on('click', function () {
            let item = $(this).data('item');
            $('#cart-item-'+item).remove();
        });
    });
</script>
