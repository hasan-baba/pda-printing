@extends('layouts.admin')
@section('title', 'Dashboard - PDA')
@section('content')
<div class="dash-content mb-5">
    <div class="overview">
        <div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Dashboard</span>
        </div>

        <div class="boxes">
            <div class="box box1">
                <i class="uil uil-analytics"></i>
                <span class="text text-center">Total Completed<br/> Enquiries</span>
                <span class="number">{{$totalCompleted}}</span>
            </div>
            <div class="box box2">
                <i class="uil uil-receipt-alt"></i>
                <span class="text text-center">Total Pending<br/> Payment Enquiries</span>
                <span class="number">{{$totalPendingPayment}}</span>
            </div>
            <div class="box box3">
                <i class="uil uil-bill"></i>
                <span class="text text-center">Total Accepted<br/> Enquiries</span>
                <span class="number">{{$totalAccepted}}</span>
            </div>
        </div>
    </div>

    <div class="activity">
        <div class="title">
            <i class="uil uil-clock-three"></i>
            <span class="text">Recent Activity</span>
        </div>

        <div class="activity-data">
            <div class="data names">
                <span class="data-title">Customer Name</span>
                @foreach($trips as $trip)
                    <span class="data-list">{{$trip->customer_name}}</span>
                @endforeach
            </div>
            <div class="data vessel">
                <span class="data-title">Vessel</span>
                @foreach($trips as $trip)
                    <span class="data-list">{{$trip->vessel}}</span>
                @endforeach
            </div>
            <div class="data status">
                <span class="data-title">Status</span>
                @foreach($trips as $trip)
                    <span class="data-list">{{$trip->enquiry->status ?? 'Approved'}}</span>
                @endforeach
            </div>
            <div class="data joined">
                <span class="data-title">Date</span>
                @foreach($trips as $trip)
                    <span class="data-list">{{$trip->eta}}</span>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
