@extends('layouts.admin')
@section('title', 'Trip Enquiry - PDA')
@section('content')
    <div class="dash-content int-enquiry mb-5">
        <div class="main">
            <div class="title">
                <i class="uil uil-setting"></i>
                <span class="text">International Enquiry</span>
            </div>
            <div class="row">
                <div class="title col-md-4">
                    <label class="text mr-2">Status</label>
                    <select id="status_selection" class="form-control" aria-label="Default select example">
                        <option value="Pending Approval" {{$status ==  'Pending Approval'? 'selected':''}}>Pending Approval</option>
                        <option value="Accepted" {{$status ==  'Accepted'? 'selected':''}}>Accepted</option>
                        <option value="RDA Completed" {{$status ==  'RDA Completed'? 'selected':''}}>RDA Completed</option>
                        <option value="Pending Payment" {{$status ==  'Pending Payment'? 'selected':''}}>Pending Payment</option>
                        <option value="Completed" {{$status ==  'Completed'? 'selected':''}}>Completed</option>
                        <option value="Rejected" {{$status ==  'Rejected'? 'selected':''}}>Rejected</option>
                    </select>
                </div>
                <div class="title col-md-4">
                    <label class="text mr-2">Currency</label>
                    <select id="currency" class="form-control">
                        @foreach($currencies as $currency)
                            <option value="{{$currency->id}}" {{$currency_id == $currency->id ? 'selected' : ''}}>{{$currency->code.' '.$currency->symbol}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="title col-md-4">
                    <label class="text mr-2">Bank</label>
                    <select id="bank" class="form-control">
                        <option value="0">Choose Bank</option>
                        @foreach($banks as $bank)
                            <option value="{{$bank->id}}" {{$bank_id == $bank->id ? 'selected' : ''}}>{{$bank->name}} - {{$bank->cur->name}} {{$bank->cur->symbol}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="invoice container-fluid">
                <div class="row d-flex">
                    <div class="col-md-12 p-0 stretch-card">
                        <div class="card">
                            <div class="card-body enquiry_section">
                                <div class="table-responsive">
                                    <table id="faqs" class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Service Description</th>
                                            <th>Qty</th>
                                            <th>PD/A</th>
                                            <th>Revised D/A</th>
                                            <th>Final D/A</th>
                                            <th>Notes</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($enquiry_exists)
                                            @php $j=1; @endphp
                                            @foreach($data as $row)
                                                    <tr id="faqs-row-{{$j}}">
                                                        <td><div class="form-group"><textarea class="form-control" id="description" name="description" rows="4">{{$row[0]}}</textarea></div></td>
                                                        <td><input type="number" class="form-control" id="qty" name="qty" value="{{$row[1]}}" min="1"></td>
                                                        <td><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text change-currency">$</span></div><input type="number" id="t1" name="t1" min="1" class="form-control" value="{{$row[2]}}"></div></td>
                                                        <td><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text change-currency">$</span></div><input type="number" id="t2" name="t2" min="1" class="form-control" value="{{$row[3]}}"></div></td>
                                                        <td><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text change-currency">$</span></div><input type="number" id="t3" name="t3" min="1" class="form-control" value="{{$row[4]}}"></div></td>
                                                        <td><div class="form-group"><textarea class="form-control" id="notes" name="notes" rows="4">{{$row[5]}}</textarea></div></td>
                                                        <td class="mt-10"><button class="badge badge-danger" onclick="$('#faqs-row-{{$j}}').remove();"><i class="fa fa-trash"></i> Delete</button></td>
                                                    </tr>
                                                    @php $j +=1; @endphp
                                            @endforeach
                                        @else
                                            @php $i=1; @endphp
                                            @foreach($array as $arr)
                                                <tr id="faqs-row-{{$i}}">
                                                    <td>
                                                        <div class="form-group">
                                                            <textarea class="form-control" name="description" id="description">{{$arr}}</textarea>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" id="qty" name="qty" value="1">
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text change-currency">$</span>
                                                            </div>
                                                            <input type="number" id="t1" name="t1" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text change-currency">$</span>
                                                            </div>
                                                            <input type="number" id="t2" name="t2" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text change-currency">$</span>
                                                            </div>
                                                            <input type="number" id="t3" name="t3" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <textarea class="form-control" name="notes" id="notes"></textarea>
                                                        </div>
                                                    </td>
                                                    <td class="mt-10">
                                                        <button class="badge badge-danger" onclick="$('#faqs-row-{{$i}}').remove();"><i class="fa fa-trash"></i> Delete</button>
                                                    </td>
                                                </tr>
                                                @php $i +=1; @endphp
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                    <table id="total" class="table table-hover">
                                        <tr>
                                            <td class="text-right">
                                                <div class="mb-2">
                                                    <strong>Total</strong>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td>
                                                <div class="mb-2">
                                                    <strong>PD/A</strong>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text change-currency">$</span>
                                                    </div>
                                                    <input type="number" class="form-control" id="total_exp1" disabled>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-2">
                                                    <strong>REVISED D/A</strong>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text change-currency">$</span>
                                                    </div>
                                                    <input type="number" class="form-control" id="total_exp2" disabled>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-2">
                                                    <strong>FINAL D/A</strong>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text change-currency">$</span>
                                                    </div>
                                                    <input type="number" class="form-control" id="total_exp3" disabled>
                                                </div>
                                                <label for="inlineFormInputGroup"><small>Advanced Payment</small></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text change-currency">$</span>
                                                    </div>
                                                    <input type="number" class="form-control" id="advanced_payment" value="{{$advanced_payment ? $advanced_payment : 0}}">
                                                </div>
                                                <label for="inlineFormInputGroup"><small>Remaining Balance</small></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text change-currency">$</span>
                                                    </div>
                                                    <input type="number" class="form-control" id="remaining_balance" value="" disabled>
                                                </div>
                                                <label for="inlineFormInputGroup"><small>Payment Reference</small></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="payment_reference" value="{{$payment_reference ?? ''}}">
                                                </div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="text-center">
                                    <button onclick="addfaqs();" class="badge badge-success"><i class="fa fa-plus"></i> ADD NEW</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <strong>Statement</strong>
                <textarea class="form-control" id="statement" name="statement" rows="4" placeholder="Enquiry Statment">{{$statement ?? ''}}</textarea>
            </div>
            <div class="text-right mt-5 actions">
                <form id="enquiry">
                    <input type="hidden" id="trip_id" value="{{$id}}">
                </form>
                <a href="#" id="save-enquiry">
                    <button class="btn">
                        Save Changes
                    </button>
                </a>
            </div>
            <div class="text-center mt-5 actions">
                <a href="#" id="estimated-enquiry">
                    <button class="btn">
                        Download PDA
                    </button>
                </a>
                <a href="#" id="departure-enquiry">
                    <button class="btn">
                        Download RDA
                    </button>
                </a>
                <a href="#" id="download-enquiry">
                    <button class="btn">
                        Download FDA
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection
@if ($status == 'Completed')
    @section('custom-enq-js')
    <script>
        $('.enquiry_section input, .card-body textarea, .enquiry_section select, .enquiry_section button').attr('readonly', 'readonly');
        $('.enquiry_section button').attr('disabled', 'true');
    </script>
    @endsection
@endif
