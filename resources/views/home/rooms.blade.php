@extends('layouts.web.web2')
@section('content')
    <div class="container">
        @if ($rooms->isEmpty())
            <div class="alert alert-danger" role="alert">
                Please select another room because the room you selected is booked.
            </div>
        @else
            @foreach ($rooms as $room)
                <x-rooms-list-item :room="$room" />
            @endforeach
        @endif
    </div>
@endsection
