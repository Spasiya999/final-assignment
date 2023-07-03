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
            'room_type' => $request->room_type,
            'short_description' => $request->short_Description,
            'description' => $request->description,
            'beds' => $request->beds,
            'occupancy' => $request->occupancy,
            'price' => $request->price,
            'status' => $request->status,
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
        $data = [
            'room_name' => $request->room_name,
            'room_number' => $request->room_no,
            'room_type' => $request->room_type,
            'short_description' => $request->short_Description,
            'description' => $request->description ?? 'not fix',
            'beds' => $request->beds,
            'occupancy' => $request->occupancy,
            'price' => $request->price,
            'status' => $request->status,
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
}
