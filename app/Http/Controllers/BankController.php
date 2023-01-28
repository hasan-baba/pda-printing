<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function store(Request $request) {
        $bank = new Bank;
        $bank->name = $request->input('bank_name');
        $bank->branch = $request->input('branch');
        $bank->swift = $request->input('swift');
        $bank->location = $request->input('bank_location');
        $bank->city = $request->input('city');
        $bank->country = $request->input('country');
        $bank->account_number = $request->input('account_nb');
        $bank->iban = $request->input('iban');
        $bank->currency = $request->input('currency');
        $bank->beneficiary_name = $request->input('beneficiary_name');
        $bank->save();
        return response()->json([
            'status' => 200,
            'message' => 'Added Successfully'
        ]);
    }
    public function edit($id) {
        $bank = Bank::findOrFail($id);
        return response()->json([
            'bank' => $bank
        ]);
    }
    public function update(Request $request, $id) {
        $bank = Bank::findOrFail($id);
        $bank->name = $request->input('bank_name');
        $bank->branch = $request->input('branch');
        $bank->swift = $request->input('swift');
        $bank->location = $request->input('bank_location');
        $bank->city = $request->input('city');
        $bank->country = $request->input('country');
        $bank->account_number = $request->input('account_nb');
        $bank->iban = $request->input('iban');
        $bank->currency = $request->input('currency');
        $bank->beneficiary_name = $request->input('beneficiary_name');
        $bank->update();
        return response()->json([
            'status' => 200,
            'message' => 'Successfully Updated'
        ]);
    }
    public function destroy($id) {
        $bank = Bank::findOrFail($id);
        $bank->delete();
        return response()->json(
            ['status' => 'Deleted Successfully!']
        );
    }
}
