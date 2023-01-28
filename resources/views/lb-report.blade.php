@extends('layouts.admin')
@section('title', 'Reports - PDA')
@section('content')
    <div class="dash-content mb-5">
        <div class="main">
            <div class="title">
                <i class="uil uil-file-graph"></i>
                <span class="text">Reports</span>
            </div>
        </div>
        <div class="container">
            <div class="filtering_section">
                <div class="row border-dark">
                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="text mr-2">From Date</label>
                            <input type="date" id="min" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label class="text mr-2">To Date</label>
                            <input type="date" id="max" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="text mr-2">Status</label>

                        <div class="category-filter">
                            <select id="categoryFilter" class="form-control">
                                <option value="">Show All</option>
                                <option value="Approved">Approved</option>
                                <option value="Pending Approval">Pending Approval</option>
                                <option value="Pending Payment">Pending Payment</option>
                                <option value="Completed">Completed</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <table id="reportTable" class="stripe display nowrap" style="width: 100%">
                            <thead>
                            <tr>
                                <th>DA Id</th>
                                <th>Customer Name</th>
                                <th>Port</th>
                                <th>Vessel Name</th>
                                <th>ETA</th>
                                <th>Enquiry Status</th>
                                <th>PDA Total</th>
                                <th>RDA Total</th>
                                <th>FDA Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trips as $trip)
                                <tr>
                                    <td>{{$trip->enquiry->da_nb ?? ''}}</td>
                                    <td>{{$trip->customer_name}}</td>
                                    <td>{{$trip->port}}</td>
                                    <td>{{$trip->vessel}}</td>
                                    <td>{{$trip->eta}}</td>
                                    <td>{{$trip->enquiry->status ?? ''}}</td>
                                    <td>
                                        @php
                                            $total = 0;
                                            $arr = $trip->enquiry->data ?? '';
                                            if($arr != '') {
                                                foreach ($arr as $dt) {
                                                    $total += $dt[1]*$dt[2];
                                                }
                                            }
                                        @endphp
                                        {{$total ?? ''}} {{$trip->enquiry->currency->symbol ?? '' }}
                                    </td>
                                    <td>
                                        @php
                                            $total1 = 0;
                                            $arr = $trip->enquiry->data ?? '';
                                            if($arr != '') {
                                                foreach ($arr as $dt) {
                                                    $total1 += $dt[1]*$dt[3];
                                                }
                                            }
                                        @endphp
                                        {{$total1 ?? ''}} {{$trip->enquiry->currency->symbol ?? '' }}
                                    </td>
                                    <td>
                                        @php
                                            $total2 = 0;
                                            $arr = $trip->enquiry->data ?? '';
                                            if($arr != '') {
                                                foreach ($arr as $dt) {
                                                    $total2 += $dt[1]*$dt[4];
                                                }
                                            }
                                        @endphp
                                        {{$total2 ?? ''}} {{$trip->enquiry->currency->symbol ?? '' }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>DA Id</th>
                                <th>Customer Name</th>
                                <th>Port</th>
                                <th>Vessel Name</th>
                                <th>ETA</th>
                                <th>Enquiry Status</th>
                                <th>PDA Total</th>
                                <th>RDA Total</th>
                                <th>FDA Total</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
