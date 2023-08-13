<x-app-layout>
    @section('content')
        <div class="m-3">
            <table id="orders" class="table table-bordered table-striped dataTable dtr-inline">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total</th>
                        <th>Customer Name</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endsection
    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    @endpush
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
        <script>
            let table = $('#orders').DataTable({
                processing: true,
                serverSide: true,
                lengthMenu:[
                    [5,10,25,50,-1],
                    [5,10,25,50,"All"]
                ],
                ajax: {
                    url: "{{route('admin.ordersTabale')}}",
                    method: 'GET'
                }
            })

            $(document).on('click', '.cancel-btn', function(){
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{url('dashboard/orders')}}/"+id+'/cancel',
                            method: 'PUT',
                            data: {
                                _token: "{{csrf_token()}}"
                            },
                            success: function(response){
                                Swal.fire(
                                'Cancelled!',
                                response.message,
                                'success'
                                )
                                table.draw();
                            },
                            error:function(response){
                                console.log(response);
                            }
                        })
                    }
                    })
            });

            $(document).on('click', '.approve-btn', function(){
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, approve it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{url('dashboard/orders')}}/"+id+'/approve',
                            method: 'PUT',
                            data: {
                                _token: "{{csrf_token()}}"
                            },
                            success: function(response){
                                Swal.fire(
                                'approved!',
                                response.message,
                                'success'
                                )
                                table.draw();
                            },
                            error:function(response){
                                console.log(response);
                            }
                        })
                    }
                    })
            });

        </script>
    @endpush
</x-app-layout>
