@extends('layouts.web.web2')
@section('content')
<div class="container">
    <x-room-inside :room="$room" />
</div>
@endsection
