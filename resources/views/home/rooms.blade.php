@extends('layouts.web.web2')
@section('content')
    <div class="container">
        @foreach ($rooms as $room)
            <x-rooms-list-item :room="$room" />
        @endforeach
    </div>
@endsection
