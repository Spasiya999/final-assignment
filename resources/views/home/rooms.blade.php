@extends('layouts.web.web2')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 m-3">
            <div class="card rounded shadow">
                <img class="rounded" src="https://img.freepik.com/free-photo/modern-studio-apartment-design-with-bedroom-living-space_1262-12375.jpg?w=1380&t=st=1688743952~exp=1688744552~hmac=41f9f54864031c39f226531cd542f5c0fbf2204229a3810af210b49dbe832c17" alt="">
                <div class="card-body">
                    <div class="card-title text-center rounded">
                        <h2>Room Name</h2>
                    </div>
                    <p class="short-description">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laboriosam voluptatem recusandae ipsam tempore, delectus sequi?
                    </p>
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6">
                            Beds: 4 <br>
                            Occupancy: 8
                        </div>
                        <div class="col-md-6 text-end">
                            <h5 class="me-auto">Price: 100000.00</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
