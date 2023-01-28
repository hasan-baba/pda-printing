<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Currency;
use App\Models\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        $company_name = Setting::where('key', 'company_name')->select('value')->first();
        $location = Setting::where('key', 'location')->select('value')->first();
        $building = Setting::where('key', 'building')->select('value')->first();
        $po_box = Setting::where('key', 'po_box')->select('value')->first();
        $city = Setting::where('key', 'city')->select('value')->first();
        $country = Setting::where('key', 'country')->select('value')->first();
        $tel_nb = Setting::where('key', 'tel_nb')->select('value')->first();
        $fax = Setting::where('key', 'fax')->select('value')->first();
        $img_logo = Setting::where('key', 'img_logo')->select('value')->first();
        $banks = Bank::with('cur')->get();
        $currencies = Currency::all();

        return view('setting',
            [
                'company_name' => $company_name,
                'location' => $location,
                'building' => $building,
                'po_box' => $po_box,
                'city' => $city,
                'country' => $country,
                'tel_nb' => $tel_nb,
                'fax' => $fax,
                'img_logo' => $img_logo,
                'banks' => $banks,
                'currencies' => $currencies
            ]);
    }
    public function store(Request $request) {
        if($request->hasFile('img_logo')) {
            $file = $request->file('img_logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/logo/',$filename);
        } else {
            $str = DB::table('settings')->where('key', 'img_logo')->pluck('value');
            $filename = $str[0];
        }
        $data = [
            ['key' => 'company_name', 'value' => $request->input('company_name')],
            ['key' => 'location', 'value' => $request->input('location')],
            ['key' => 'building', 'value' => $request->input('building')],
            ['key' => 'po_box', 'value' => $request->input('po_box')],
            ['key' => 'city', 'value' => $request->input('city')],
            ['key' => 'country', 'value' => $request->input('country')],
            ['key' => 'tel_nb', 'value' => $request->input('tel_nb')],
            ['key' => 'fax', 'value' => $request->input('fax')],
            ['key' => 'img_logo', 'value' => $filename]
        ];
        DB::table('settings')->upsert(
            $data
        , ['key']);
        return response()->json([
            'status' => 200,
            'message' => 'Added Successfully'
        ]);
    }
}
