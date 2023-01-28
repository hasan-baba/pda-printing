<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Currency;
use App\Models\Enquiry;
use App\Models\LebaneseEnquiry;
use App\Models\Setting;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LebaneseEnquiryController extends Controller
{
    public function index()
    {
        $enquiries = LebaneseEnquiry::all();
        $trips = Trip::with('lbenquiry')->get();
        if(count(LebaneseEnquiry::all()) > 0) {
            $enquiry_lastID = LebaneseEnquiry::all()->last()->id;
        } else {
            $enquiry_lastID = 0;
        }
        return view('lb-enquiry',
            [
                'enquiries' => $enquiries,
                'trips' => $trips,
                'enquiry_lastID' => $enquiry_lastID
            ]);
    }

    public function report()
    {
        $trips = Trip::with('lbenquiry.currency')->get();
        return view('lb-report', [
            'trips' => $trips
        ]);
    }

    public function store(Request $request) {
        $data = $request->input('data');
        $status = $request->input('status');
        $statement = $request->input('statement');
        $currency = $request->input('currency');
        $bank = $request->input('bank');

        if(count(LebaneseEnquiry::all()) > 0) {
            if(DB::table('lebanese_enquiries')->where('trip_id', $request->input('trip_id'))->get()->count() > 0) {
                $enq_trip = DB::table('lebanese_enquiries')->where('trip_id', $request->input('trip_id'))->first();
                $da_nb = $enq_trip->da_nb;
            } else {
                $last_enquiryID = (LebaneseEnquiry::all()->last()->id) + 1;
                $formatted_nb = str_pad($last_enquiryID, 3, '0', STR_PAD_LEFT);
                $da_nb = 'LB-'.date('Y').$formatted_nb;
            }
        } else {
            $da_nb = 'LB-'.date('Y')*1000 + 1;
        }
        $enquiry = LebaneseEnquiry::updateOrCreate(
            ['trip_id' => $request->input('trip_id'), 'da_nb' => $da_nb],
            [
                'data' => $data,
                'advanced_payment' => $request->input('advanced_payment'),
                'advanced_payment_lb' => $request->input('advanced_payment_lb'),
                'status' => $status,
                'payment_reference' => $request->input('payment_reference'),
                'payment_reference_lb' => $request->input('payment_reference_lb'),
                'statement' => $statement,
                'currency_id' => $currency,
                'bank_id' => $bank
            ]
        );
        return response()->json([
            'status' => 200,
            'message' => 'Added Successfully',
        ]);
    }
    public function view($id) {
        $array = [
            'Harbor master dues ( clearance des and light dues',
            'Pilotage',
            'Harbor master office dues ( dues on pilotage)',
            'Immigration dues',
            'Fiscal stamps',
            'Launch hire',
            'Port overtime',
            'Agency fee'
        ];
        $enquiry_exists =  DB::table('lebanese_enquiries')->where('trip_id', $id)->exists();
        if($enquiry_exists) {
            $enquiry = DB::table('lebanese_enquiries')->where('trip_id', $id)->first();
            $data = json_decode($enquiry->data);
            $status = $enquiry->status;
            $advanced_payment = $enquiry->advanced_payment;
            $payment_reference = $enquiry->payment_reference;
            $advanced_payment_lb = $enquiry->advanced_payment_lb;
            $payment_reference_lb = $enquiry->payment_reference_lb;
            $statement = $enquiry->statement;
            $currency_id = $enquiry->currency_id;
            $bank_id = $enquiry->bank_id;
        } else {
            $data = '';
            $status = '';
            $advanced_payment = '';
            $payment_reference = '';
            $statement = '';
            $currency_id = '';
            $bank_id = '';
            $advanced_payment_lb = '';
            $payment_reference_lb = '';
        }
        $currencies = Currency::all();
        $banks = Bank::with('cur')->get();
        return view(
            'trip-lb-enquiry',
            [
                'id' => $id,
                'array' => $array,
                'enquiry_exists' => $enquiry_exists,
                'data' => $data,
                'status' => $status,
                'advanced_payment' => $advanced_payment,
                'payment_reference' => $payment_reference,
                'statement' => $statement,
                'currencies' => $currencies,
                'currency_id' => $currency_id,
                'banks' => $banks,
                'bank_id' => $bank_id,
                'advanced_payment_lb' => $advanced_payment_lb,
                'payment_reference_lb' => $payment_reference_lb
            ]
        );
    }
    public function download($id) {
        // settings data
        $company_name = Setting::where('key', 'company_name')->select('value')->first();
        $location = Setting::where('key', 'location')->select('value')->first();
        $building = Setting::where('key', 'building')->select('value')->first();
        $po_box = Setting::where('key', 'po_box')->select('value')->first();
        $city = Setting::where('key', 'city')->select('value')->first();
        $country = Setting::where('key', 'country')->select('value')->first();
        $tel_nb = Setting::where('key', 'tel_nb')->select('value')->first();
        $fax = Setting::where('key', 'fax')->select('value')->first();
        $img_logo = Setting::where('key', 'img_logo')->select('value')->first();

        // enquiry data
        $enquiries = DB::table('lebanese_enquiries')->where('trip_id', $id)->first();
        $trip = DB::table('trips')->where('id', $id)->first();
        $status = $enquiries->status;
        $data = json_decode($enquiries->data);
        $payment_reference = $enquiries->payment_reference;
        $payment_reference_lb = $enquiries->payment_reference_lb;
        $statement = $enquiries->statement;
        $enquiry_with_currency = LebaneseEnquiry::with('currency', 'bank')->where('trip_id', $id)->first();

        return view('lb-pdf', [
            'data' => $data,
            'company_name' => $company_name,
            'location' => $location,
            'building' => $building,
            'po_box' => $po_box,
            'city' => $city,
            'country' => $country,
            'tel_nb' => $tel_nb,
            'fax' => $fax,
            'img_logo' => $img_logo,
            'status' => $status,
            'trip' => $trip,
            'enquiries' => $enquiries,
            'payment_reference' => $payment_reference,
            'payment_reference_lb' => $payment_reference_lb,
            'statement' => $statement,
            'enquiry_with_currency' => $enquiry_with_currency
        ]);
    }

    public function downloadTotal1($id) {
        // settings data
        $company_name = Setting::where('key', 'company_name')->select('value')->first();
        $location = Setting::where('key', 'location')->select('value')->first();
        $building = Setting::where('key', 'building')->select('value')->first();
        $po_box = Setting::where('key', 'po_box')->select('value')->first();
        $city = Setting::where('key', 'city')->select('value')->first();
        $country = Setting::where('key', 'country')->select('value')->first();
        $tel_nb = Setting::where('key', 'tel_nb')->select('value')->first();
        $fax = Setting::where('key', 'fax')->select('value')->first();
        $img_logo = Setting::where('key', 'img_logo')->select('value')->first();

        // enquiry data
        $enquiries = DB::table('lebanese_enquiries')->where('trip_id', $id)->first();
        $trip = DB::table('trips')->where('id', $id)->first();
        $status = $enquiries->status;
        $data = json_decode($enquiries->data);
        $payment_reference = $enquiries->payment_reference;
        $payment_reference_lb = $enquiries->payment_reference_lb;
        $statement = $enquiries->statement;
        $enquiry_with_currency = LebaneseEnquiry::with('currency', 'bank')->where('trip_id', $id)->first();

        return view('lb-pdf-total1', [
            'data' => $data,
            'company_name' => $company_name,
            'location' => $location,
            'building' => $building,
            'po_box' => $po_box,
            'city' => $city,
            'country' => $country,
            'tel_nb' => $tel_nb,
            'fax' => $fax,
            'img_logo' => $img_logo,
            'status' => $status,
            'trip' => $trip,
            'enquiries' => $enquiries,
            'payment_reference' => $payment_reference,
            'payment_reference_lb' => $payment_reference_lb,
            'statement' => $statement,
            'enquiry_with_currency' => $enquiry_with_currency
        ]);
    }

    public function downloadTotal2($id) {
        // settings data
        $company_name = Setting::where('key', 'company_name')->select('value')->first();
        $location = Setting::where('key', 'location')->select('value')->first();
        $building = Setting::where('key', 'building')->select('value')->first();
        $po_box = Setting::where('key', 'po_box')->select('value')->first();
        $city = Setting::where('key', 'city')->select('value')->first();
        $country = Setting::where('key', 'country')->select('value')->first();
        $tel_nb = Setting::where('key', 'tel_nb')->select('value')->first();
        $fax = Setting::where('key', 'fax')->select('value')->first();
        $img_logo = Setting::where('key', 'img_logo')->select('value')->first();

        // enquiry data
        $enquiries = DB::table('lebanese_enquiries')->where('trip_id', $id)->first();
        $trip = DB::table('trips')->where('id', $id)->first();
        $status = $enquiries->status;
        $data = json_decode($enquiries->data);
        $payment_reference = $enquiries->payment_reference;
        $payment_reference_lb = $enquiries->payment_reference_lb;
        $statement = $enquiries->statement;
        $enquiry_with_currency = LebaneseEnquiry::with('currency', 'bank')->where('trip_id', $id)->first();

        return view('lb-pdf-total2', [
            'data' => $data,
            'company_name' => $company_name,
            'location' => $location,
            'building' => $building,
            'po_box' => $po_box,
            'city' => $city,
            'country' => $country,
            'tel_nb' => $tel_nb,
            'fax' => $fax,
            'img_logo' => $img_logo,
            'status' => $status,
            'trip' => $trip,
            'enquiries' => $enquiries,
            'payment_reference' => $payment_reference,
            'payment_reference_lb' => $payment_reference_lb,
            'statement' => $statement,
            'enquiry_with_currency' => $enquiry_with_currency
        ]);
    }

    public function update_status(Request $request){
        $trip_id = $request->input('trip_id');
        $status = $request->input('status');
        $enquiry_exists = DB::table('lebanese_enquiries')->where('trip_id', $trip_id)->exists();
        if($enquiry_exists) {
            LebaneseEnquiry::where('trip_id', $trip_id)->update(
                ['status' => $status]
            );
        }

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully'
        ]);
    }

    public function update_currency(Request $request){
        $trip_id = $request->input('trip_id');
        $currency_id = $request->input('currency');
        $enquiry_exists = DB::table('lebanese_enquiries')->where('trip_id', $trip_id)->exists();
        if($enquiry_exists) {
            Enquiry::where('trip_id', $trip_id)->update(
                ['currency_id' => $currency_id]
            );
        }

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully'
        ]);
    }

    public function update_bank(Request $request){
        $trip_id = $request->input('trip_id');
        $bank_id = $request->input('bank');
        $enquiry_exists = DB::table('lebanese_enquiries')->where('trip_id', $trip_id)->exists();
        if($enquiry_exists) {
            LebaneseEnquiry::where('trip_id', $trip_id)->update(
                ['bank_id' => $bank_id]
            );
        }

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully'
        ]);
    }
}
