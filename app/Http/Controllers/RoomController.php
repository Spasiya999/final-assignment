<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Room::roomTypes;
        $statuses = Room::roomStatus;
        return view('admin.rooms.create', compact('types', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        $data = [
            'room_name' => $request->room_name,
            'room_number' => $request->room_no,
            'room_type' => $request->room_type ?? 'Standard',
            'short_description' => $request->short_Description,
            'description' => $request->description ?? '',
            'beds' => $request->beds,
            'occupancy' => $request->occupancy,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $request->image,
        ];
        // dd($data);
        Room::create($data);
        return redirect()->route('room.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $room = Room::find($room->id);
        $types = Room::roomTypes;
        $statuses = Room::roomStatus;
        return view('admin.rooms.edit', compact('room', 'types', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        // dd($request->all());
        if($request->image != $room->image && !empty($room->image)){
            Storage::disk('public')->delete($room->image);
        }
        $data = [
            'room_name' => $request->room_name,
            'room_number' => $request->room_no,
            'room_type' => $request->room_type,
            'short_description' => $request->short_Description,
            'description' => $request->description,
            'beds' => $request->beds,
            'occupancy' => $request->occupancy,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $request->image,
        ];

        $room->update($data);
        return redirect()->route('room.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete($room);
        return redirect()->route('room.index');
    }

    public function imageUpload(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3072', // 3MB
        ]);
        $file = $request->file('image');
        $path = $file->store('uploads', 'public');

        if($path){
            return response()->json([
                'status' => true,
                'image' => $path
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Image upload failed'
            ]);
        }
    }
}
