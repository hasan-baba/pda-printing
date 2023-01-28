@extends('layouts.admin')
@section('title', 'Settings - PDA')
@section('content')
<div class="dash-content mb-5">
    <div class="main">
        <div class="title">
            <i class="uil uil-setting"></i>
            <span class="text">Settings</span>
        </div>
        <div class="setting-form container-fluid">
            <form id="setting-form">
                @csrf
                <div class="company-details">
                    <div class="row mb-3">
                        <h5>Company Details</h5>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-form-label col-md-3 pl-0">Company Name</label>
                        <input type="text" class="form-control col-md-7" id="" name="company_name" placeholder="" value="{{$company_name['value'] ?? ''}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-form-label col-md-3 pl-0">Location</label>
                        <input type="text" class="form-control col-md-7" id="" name="location" placeholder="" value="{{$location['value'] ?? ''}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-form-label col-md-3 pl-0">Building</label>
                        <input type="text" class="form-control col-md-7" id="" name="building" placeholder="" value="{{$building['value'] ?? ''}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-form-label col-md-3 pl-0">P.O. Box</label>
                        <input type="text" class="form-control col-md-7" id="" name="po_box" placeholder="" value="{{$po_box['value'] ?? ''}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-form-label col-md-3 pl-0">City</label>
                        <input type="text" class="form-control col-md-7" id="" name="city" placeholder="" value="{{$city['value'] ?? ''}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-form-label col-md-3 pl-0">Country</label>
                        <input type="text" class="form-control col-md-7" id="" name="country" placeholder="" value="{{$country['value'] ?? ''}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-form-label col-md-3 pl-0">Telephone Number</label>
                        <input type="text" class="form-control col-md-7" id="" name="tel_nb" placeholder="" value="{{$tel_nb['value'] ?? ''}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-form-label col-md-3 pl-0">Fax</label>
                        <input type="text" class="form-control col-md-7" id="" name="fax" placeholder="" value="{{$fax['value'] ?? ''}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-form-label col-md-3 pl-0">Company Logo</label>
                        <div class="col-md-7 p-0">
                            <div class="preview-zone hidden">
                                <div class="box box-solid">
                                    <div class="box-body mb-3">
                                        @if(!empty($img_logo['value']))
                                            <img width="200" src="{{asset('/uploads/logo/'.$img_logo['value'])}}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="dropzone-wrapper">
                                <div class="dropzone-desc">
                                    <i class="uil uil-import"></i>
                                    <p>Choose an image file or drag it here.</p>
                                </div>
                                <input type="file" name="img_logo" accept="image/*" id="img_logo" class="dropzone" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-7 p-0 text-right">
                        <button type="button" class="btn setting-btn" id="setting-btn">Save Changes</button>
                    </div>
                </div>
            </form>
            <div class="bank-details">
                <div class="row mb-5 pt-2">
                    <div class="col-md-12 d-flex align-items-center">
                        <h5>Bank Details</h5>
                        <button type="button" class="btn ml-3" data-toggle="modal" data-target="#bankModal">Add Bank</button>                        </div>
                </div>
                <table id="bankTable" class="stripe display nowrap" style="width: 100%">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>Bank Name</th>
                        <th>Branch</th>
                        <th>Bank Address</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Currency</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($banks as $bank)
                        <tr>
                            <td>
                                <input type="hidden" id="bank_id" value="{{$bank->id}}">
                                <form action="{{url('/admin/bank/'.$bank->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <i class="uil uil-times-square delete" id="delete-bank"></i>
                                </form>
                                <i class="uil uil-edit edit" id="edit-bank" data-toggle="modal" data-target="#bankEditModal"></i>
                            </td>
                            <td>{{$bank->name}}</td>
                            <td>{{$bank->branch}}</td>
                            <td>{{$bank->location}}</td>
                            <td>{{$bank->city}}</td>
                            <td>{{$bank->country}}</td>
                            <td>{{$bank->cur->name}} {{$bank->cur->symbol}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Action</th>
                        <th>Bank Name</th>
                        <th>Branch</th>
                        <th>Bank Address</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Currency</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Add Bank Modal -->
<div class="modal fade" id="bankModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Bank Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation container" id="bankForm" novalidate>
                    @csrf
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Bank Name</label>
                        <input type="text" class="form-control col-md-9" id="" name="bank_name" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Branch</label>
                        <input type="text" class="form-control col-md-9" id="" name="branch" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Swift</label>
                        <input type="text" class="form-control col-md-9" id="" name="swift" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Bank Address</label>
                        <input type="text" class="form-control col-md-9" id="" name="bank_location" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">City</label>
                        <input type="text" class="form-control col-md-9" id="" name="city" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Country</label>
                        <input type="text" class="form-control col-md-9" id="" name="country" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Account Number</label>
                        <input type="text" class="form-control col-md-9" id="" name="account_nb" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">IBAN</label>
                        <input type="text" class="form-control col-md-9" id="" name="iban" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Currency</label>
                        <select name="currency" class="form-control col-md-9">
                            @foreach($currencies as $currency)
                                <option value="{{$currency->id}}">{{$currency->code.' '.$currency->symbol}}</option>
                            @endforeach
                        </select>
{{--                        <input type="text" class="form-control col-md-9" id=""  placeholder="">--}}
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Beneficiary Name</label>
                        <input type="text" class="form-control col-md-9" id="" name="beneficiary_name" placeholder="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn" id="add_bank">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Bank Modal -->
<div class="modal fade" id="bankEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Bank Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation container" id="bankEditForm" novalidate>
                    @csrf
                    <div class="form-row mt-3">
                        <input type="hidden" value="" id="edit_bank_id" name="edit_bank_id">
                        <label for="" class="col-form-label col-md-3 pl-0">Bank Name</label>
                        <input type="text" class="form-control col-md-9" id="bank_name" name="bank_name" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Branch</label>
                        <input type="text" class="form-control col-md-9" id="branch" name="branch" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Swift</label>
                        <input type="text" class="form-control col-md-9" id="swift" name="swift" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Bank Address</label>
                        <input type="text" class="form-control col-md-9" id="bank_location" name="bank_location" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">City</label>
                        <input type="text" class="form-control col-md-9" id="city" name="city" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Country</label>
                        <input type="text" class="form-control col-md-9" id="country" name="country" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Account Number</label>
                        <input type="text" class="form-control col-md-9" id="account_nb" name="account_nb" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">IBAN</label>
                        <input type="text" class="form-control col-md-9" id="iban" name="iban" placeholder="">
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Currency</label>
                        <select id="currency" name="currency" class="form-control col-md-9">
                            @foreach($currencies as $currency)
                                <option value="{{$currency->id}}">{{$currency->code.' '.$currency->symbol}}</option>
                            @endforeach
                        </select>
{{--                        <input type="text" class="form-control col-md-9" id="currency" name="currency" placeholder="">--}}
                    </div>
                    <div class="form-row mt-3">
                        <label for="" class="col-form-label col-md-3 pl-0">Beneficiary Name</label>
                        <input type="text" class="form-control col-md-9" id="beneficiary_name" name="beneficiary_name" placeholder="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn" id="update_bank">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection
