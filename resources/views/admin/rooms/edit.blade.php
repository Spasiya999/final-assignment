<x-app-layout>
    @section('content')
        <div class="card card-primary m-3">
            <div class="card-header">
                <h3 class="card-title">Add room</h3>
            </div>

            <form method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="RoomNO">Room No.</label>
                                <input type="text" class="form-control" id="roomNo" value="{{ $room->room_number }}"
                                    placeholder="Room No." name="room_no">
                            </div>
                            <div class="form-group">
                                <label for="RoomName">Room Name.</label>
                                <input type="text" class="form-control" id="room_name" value="{{ $room->room_name }}"
                                    placeholder="Room Name." name="room_name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Room type</label>
                                {{-- <h6><span class="badge bg-secondary">{{ $room->room_type }}</span></h6> --}}
                                <select name="room_type" id="room_Type" class="custom-select">
                                    <option>Select Room type</option>
                                    @foreach ($types as $key => $type)
                                        <option value="{{ $key }}"
                                            {{ $room->room_type == $key ? 'selected' : '' }}>
                                            {{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug.</label>
                                <input type="text" class="form-control" id="slug" value="{{ $room->slug }}"
                                    placeholder="Slug." name="slug">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_Description">Short Description</label>
                        <textarea class="form-control" rows="3" name="short_Description" id="short_Description" placeholder="Enter ...">{{ $room->short_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="mytextarea">{{$room->description}}</textarea>
                        <textarea class="form-control" rows="3" name="description" id="description" style="display: none;"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="beds">No.of Beds</label>
                                <input type="number" value="{{ $room->beds }}" class="form-control" id="beds"
                                    name="beds">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="occupancy">Max occupancy</label>
                                <input type="number" value="{{ $room->occupancy }}" class="form-control" id="occupancy"
                                    name="occupancy">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" value="{{ $room->price }}" class="form-control" id="price"
                                    name="price">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status"> Status</label>
                                <select class="custom-select" name="status" id="status">
                                    <option>Status</option>
                                    @foreach ($statuses as $key => $status)
                                        <option value="{{ $key }}" {{ $room->status == $key ? 'selected' : '' }}>
                                            {{ $status }}</option>
                                    @endforeach
                                </select>
                                <h6><span class="badge bg-secondary">{{ $room->status }}</span></h6>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Images</label>
                                <div id="roomImageDrop" class="dropzone {{ $room->image ? 'd-none' : '' }}"></div>
                                <x-drop-img-preview src="{{ asset('storage/' . $room->image) }}" class="{{ $room->image ? 'd-block' : 'd-none' }} w-50" id="roomImage">
                                </x-drop-img-preview>
                                <input type="hidden" name="image" id="image" value="{{ $room->image }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    @endsection
    @push('css')
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @endpush
    @push('scripts')
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <script>
            Dropzone.autoDiscover = false;

            let myDropzone = new Dropzone("#roomImageDrop", {
                url: '{{ route('room.image.upload') }}',
                maxFilesize: 3,
                acceptedFiles: 'image/*',
                paramName: 'image',
                init: function() {
                    this.on('sending', function(file, xhr, formData) {
                        formData.append('_token', '{{ csrf_token() }}');
                    });
                    this.on('success', function(file, response) {
                        console.log(response);
                        if (response.status) {
                            $('#image').val(response.image);
                            notyf.success('Image uploaded successfully')
                        } else {
                            notyf.error('Image upload failed')
                        }

                    });
                }
            });

            $('#roomImage .remove-btn').on('click', function() {
                $('#image').val('');
                $('#roomImage').addClass('d-none').removeClass('d-block');
                $('#roomImageDrop').removeClass('d-none');
            });
        </script>
    @endpush
</x-app-layout>
