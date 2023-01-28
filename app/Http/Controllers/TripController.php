<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::all();
        return view('trip',
        [
            'trips' => $trips
        ]);
    }
    public function add() {
        return view('add-trip');
    }
    public function store(Request $request) {
        $trip = new Trip;
        $trip->customer_name = $request->input('customer_name');
        $trip->address = $request->input('address');
        $trip->vessel = $request->input('vessel');
        $trip->port = $request->input('port');
        $trip->eta = $request->input('eta');
        $trip->ata = $request->input('ata');
        $trip->ats = $request->input('ats');
        $trip->terminal = $request->input('terminal');
        $trip->save();
        return response()->json([
            'status' => 200,
            'message' => 'Added Successfully'
        ]);
    }
    public function edit($id) {
        $trip = Trip::findOrFail($id);
        return response()->json([
            'trips' => $trip
        ]);
    }
    public function update(Request $request, $id) {
        $trip = Trip::findOrFail($id);
        $trip->customer_name = $request->input('customer_name');
        $trip->address = $request->input('address');
        $trip->vessel = $request->input('vessel');
        $trip->port = $request->input('port');
        $trip->eta = $request->input('eta');
        $trip->ata = $request->input('ata');
        $trip->ats = $request->input('ats');
        $trip->terminal = $request->input('terminal');
        $trip->update();
        return response()->json([
            'status' => 200,
            'message' => 'Successfully Updated'
        ]);
    }
    public function destroy($id) {
        $trip = Trip::findOrFail($id);
        $trip->delete();
        return response()->json(
            ['status' => 'Deleted Successfully!']
        );
    }
}
