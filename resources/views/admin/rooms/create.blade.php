<x-app-layout>
    @section('content')
        <div class="card card-primary m-3">
            <div class="card-header">
                <h3 class="card-title">Add room</h3>
            </div>


            <form method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="room_name">Room Name.</label>
                                <input type="text" class="form-control" id="room_name" placeholder="Room Name." name="room_name">
                            </div>
                            <div class="form-group">
                                <label for="RoomNO">Room No.</label>
                                <input type="text" class="form-control" id="roomNo" placeholder="Room No."
                                    name="room_no">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Room type</label>
                                <select class="custom-select" name="room_type" id="room_type">
                                    <option>Select Room type</option>
                                    {{-- @foreach ($statuses as $key => $status)
                                        <option value="{{ $key }}">{{ $status }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_Description">Short Description</label>
                        <textarea class="form-control" rows="3" name=short_Description id=short_Description placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <x-summernote-editor id="description-editor" placeholder="Type something here"></x-summernote-editor>
                        <textarea class="form-control" rows="3" name="description" id="description" style="display: none;"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="beds">No.of Beds</label>
                                <input type="number" class="form-control" id="beds" name="beds">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="occupancy">Max occupancy</label>
                                <input type="number" class="form-control" id="occupancy" name="occupancy">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status"> Status</label>
                                <select class="custom-select" name="status" id="status">
                                    <option>Available</option>
                                    {{-- @foreach ($statuses as $key => $status )
                                        <option value="{{$key}}">{{$status}}</option>
                                    @endforeach --}}
                                </select>
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
    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#description-editor').summernote({
                placeholder: 'Type something here',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        $('#description').val(contents); // Set the Summernote content as the value of the hidden textarea
                    }
                }
            });
        });
    </script>

    @endpush
</x-app-layout>
