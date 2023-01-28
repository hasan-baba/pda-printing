<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Enquiry;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $trips = Trip::with('enquiry')->latest()->take(3)->get();
        $totalAccepted = Enquiry::where('status', 'Accepted')->count();
        $totalCompleted = Enquiry::where('status', 'Completed')->count();
        $totalPendingPayment = Enquiry::where('status', 'Pending Payment')->count();
        return view('admin', [
            'trips' => $trips,
            'totalAccepted' => $totalAccepted,
            'totalCompleted' => $totalCompleted,
            'totalPendingPayment' => $totalPendingPayment
        ]);
    }

    public function list() {
        $users = User::all();
        return view('user', [
            'users' => $users
        ]);
    }
    public function store(Request $request) {
        $user = new User;
        $user->name = $request->input('user');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return response()->json([
            'status' => 200,
            'message' => 'Added Successfully'
        ]);
    }
    public function edit($id) {
        $user = User::findOrFail($id);
        return response()->json([
            'user' => $user
        ]);
    }
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->input('editPassword'));
        $user->update();
        return response()->json([
            'status' => 200,
            'message' => 'Successfully Updated'
        ]);
    }
    public function destroy($id) {
        $user = User::findOrFail($id);
        $current_user = auth()->user()->name;
        if($current_user == $user->name) {
            return response()->json([
                'status' => 500,
                'message' => 'You are currently logged in!'
            ]);
        } else {
            $user->delete();
            return response()->json([
                'status' => 200,
                'message' => 'User Deleted Successfully!'
            ]);
        }
    }
}
