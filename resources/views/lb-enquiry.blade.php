@extends('layouts.admin')
@section('title', 'Enquiry - PDA')
@section('content')
    <div class="dash-content mb-5">
        <div class="main">
            <div class="title">
                <i class="uil uil-setting"></i>
                <span class="text">Lebanese Enquiries</span>
            </div>
            <table id="lbEnquiryTable" class="stripe display nowrap" style="width: 100%">
                <thead>
                <tr>
                    <th>D/A Nb.</th>
                    <th>Actions</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Vessel</th>
                    <th>Port</th>
                    <th>ETA</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trips as $trip)
                    <tr>
                        <td class="text-center">{{$trip->lbenquiry->da_nb ?? '--'}}</td>
                        <td>
                            <input type="hidden" id="trip_id" value="{{$trip->id}}">
                            <a href="/admin/lb-enquiry/{{$trip->id}}">
                                <button class="btn">Enquiry</button>
                            </a>
                        </td>
                        <td>{{$trip->lbenquiry->status ?? 'Pending Approval'}}</td>
                        <td>{{$trip->customer_name}}</td>
                        <td>{{$trip->address}}</td>
                        <td>{{$trip->vessel}}</td>
                        <td>{{$trip->port}}</td>
                        <td>{{$trip->eta}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>D/A Nb.</th>
                    <th>Actions</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Vessel</th>
                    <th>Port</th>
                    <th>ETA</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
