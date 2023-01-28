@extends('layouts.admin')
@section('title', 'Add Trip - PDA')
@section('content')
    <div class="dash-content mb-5">
        <div class="main">
            <div class="title">
                <i class="uil uil-ship"></i>
                <span class="text">Add Trip</span>
            </div>
            <div class="trip-form container-fluid p-0">
                <form class="needs-validation" id="tripForm" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Customer Name</label>
                            <input type="text" class="form-control" name="customer_name" id="validationCustom01" required>
                            <div class="invalid-feedback">
                                Required
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02">Address</label>
                            <input type="text" class="form-control" name="address" id="validationCustom02" required>
                            <div class="invalid-feedback">
                                Required
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02">Terminal</label>
                            <input type="text" class="form-control" name="terminal" id="validationCustom02">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom03">Vessel</label>
                            <input type="text" class="form-control" name="vessel" id="validationCustom03" required>
                            <div class="invalid-feedback">
                                Required
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom03">Port</label>
                            <input type="text" class="form-control" name="port" id="validationCustom03" required>
                            <div class="invalid-feedback">
                                Required
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom03">ETA</label>
                            <input type="date" class="form-control" name="eta" id="validationCustom03">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom03">ATA</label>
                            <input type="date" class="form-control" name="ata" id="validationCustom03">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom03">ATS</label>
                            <input type="date" class="form-control" name="ats" id="validationCustom03">
                        </div>
                    </div>
                    <button class="btn mt-2" id="submit-trip" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
