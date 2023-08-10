@extends('layouts.web.web2')
@section('content')
    <div class="container">
        <form action="{{route('order.create')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    @php
                     $total = 0;
                    @endphp
                    @foreach ($orderItems as $item)
                    @php
                        $total += $item->amount;
                    @endphp
                        <x-order.list-item :item="$item"></x-order.list-item>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <div class="mt-3">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Summary</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                        <div>
                                            <strong>Total amount</strong>
                                        </div>
                                        <span><strong>LKR: {{$total}}.00</strong></span>
                                    </li>
                                </ul>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Create Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
