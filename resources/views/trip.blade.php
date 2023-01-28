@extends('layouts.admin')
@section('title', 'Trips - PDA')
@section('content')
    <div class="dash-content mb-5">
        <div class="main">
            <div class="title">
                <i class="uil uil-setting"></i>
                <span class="text">Trips</span>
            </div>
            <table id="tripTable" class="stripe display nowrap" style="width: 100%">
                <thead>
                <tr>
                    <th>Actions</th>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Vessel</th>
                    <th>Port</th>
                    <th>ETA</th>
                    <th>ATA</th>
                    <th>ATS</th>
                    <th>Terminal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trips as $trip)
                    <tr>
                        <td>
                            <input type="hidden" id="trip_id" value="{{$trip->id}}">
                            <form action="{{url('/admin/trip/'.$trip->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <i class="uil uil-times-square delete" id="delete-trip"></i>
                            </form>
                            <i class="uil uil-edit edit" id="edit-trip" data-toggle="modal" data-target="#tripModal"></i>
                        </td>
                        <td>{{$trip->customer_name}}</td>
                        <td>{{$trip->address}}</td>
                        <td>{{$trip->vessel}}</td>
                        <td>{{$trip->port}}</td>
                        <td>{{$trip->eta}}</td>
                        <td>{{$trip->ata}}</td>
                        <td>{{$trip->ats}}</td>
                        <td>{{$trip->terminal}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Actions</th>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Vessel</th>
                    <th>Port</th>
                    <th>ETA</th>
                    <th>ATA</th>
                    <th>ATS</th>
                    <th>Terminal</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- Trip Modal -->
    <div class="modal fade" id="tripModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Trip Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="editTripForm" novalidate>
                        @csrf
                        <div class="form-row">
                            <input type="hidden" id="edit-trip-id">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" id="edit-customer" required>
                                <div class="invalid-feedback">
                                    Required
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Address</label>
                                <input type="text" class="form-control" name="address" id="edit-address" required>
                                <div class="invalid-feedback">
                                    Required
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Terminal</label>
                                <input type="text" class="form-control" name="terminal" id="edit-terminal" required>
                                <div class="invalid-feedback">
                                    Required
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">Vessel</label>
                                <input type="text" class="form-control" name="vessel" id="edit-vessel" required>
                                <div class="invalid-feedback">
                                    Required
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">Port</label>
                                <input type="text" class="form-control" name="port" id="edit-port" required>
                                <div class="invalid-feedback">
                                    Required
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom03">ETA</label>
                                <input type="date" class="form-control" id="edit-eta" name="eta" required>
                                <div class="invalid-feedback">
                                    Required
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom03">ATA</label>
                                <input type="date" class="form-control" id="edit-ata" name="ata">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom03">ATS</label>
                                <input type="date" class="form-control" id="edit-ats" name="ats">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn" id="update-trip">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
