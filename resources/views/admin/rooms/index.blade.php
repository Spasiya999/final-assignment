<x-app-layout>
    @section('content')
        <div class="m-3">
            <table id="rooms" class="table table-bordered table-striped dataTable dtr-inline">
                <thead>
                    <tr>
                        <th>Room No.</th>
                        <th>Room Name</th>
                        <th>Room Type</th>
                        <th>Short Description</th>
                        <th>No. of Beds</th>
                        <th>Max Occupancy</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr>
                            <td>{{ $room->room_number }}</td>
                            <td>{{ $room->room_name }}</td>
                            <td>{{ $room->room_type }}</td>
                            <td>{{ $room->short_description }}</td>
                            <td>{{ $room->beds }}</td>
                            <td>{{ $room->occupancy }}</td>
                            <td>{{ $room->price }}</td>
                            <td>{{ $room->status }}</td>
                            <td>
                                <a href="{{ route('room.edit', $room->id) }}" class="btn btn-primary">Edit</a>

                                <button type="button" class="btn btn-danger delete-btn" data-room_id={{ $room->id }}
                                    data-bs-toggle="modal" data-bs-target="#deleteRoomModal">
                                    Delete
                                </button>

                            </td>
                    @endforeach
                <tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteRoomModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteRoomModal">Delete Room</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            Are you sure?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            let table = new DataTable('#rooms');
            $('.delete-btn').on('click', function() {
                let room_id = $(this).data('room_id');
                $('#deleteForm').attr('action', '/dashboard/room/' + room_id + '/delete');
            })
        </script>
    @endsection
</x-app-layout>
