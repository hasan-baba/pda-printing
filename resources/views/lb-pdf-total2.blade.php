<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="{{asset('/assets/img/invoice-1.png')}}"/>
    <link href="{{ asset('/assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <title>Invoice</title>
    <style>
        body {
            font-size: 14px!important;
        }
        p {
            margin-bottom: 0!important;
        }
        .main-content {
            max-width: 1140px;
            margin: 0 auto;
        }
        @media print {
            @page {
                size: A4;
            }
            *, img {
                color-adjust: exact!important;
                -webkit-print-color-adjust: exact!important;
                print-color-adjust: exact!important;
            }
            #download {
                display: none;
            }
            body {
                color: black;
            }
            .col-md-6, .col-sm-6 {
                width: 50%!important;
            }
        }
    </style>
</head>
<body>
<div class="main-content">
    <div class="text-center pt-3">
        <button type="button" id="download" class="btn btn-primary">Download</button>
    </div>
    <div class="container-fluid bootdey">
        <div class="row invoice row-printable">
            <div class="col-md-12">
                <div class="panel panel-default plain" id="dash_0">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">

                            </div>
                            <div class="col-lg-6">
                                <div class="invoice-from">
                                    <div class="invoice-logo text-right mb-2">
                                        @if($img_logo['value'])
                                            <img class="w-50" src="{{asset('/uploads/logo/'.$img_logo['value'].'')}}" alt="Invoice logo">
                                        @endif
                                    </div>
                                    <ul class="list-unstyled text-right">
                                        <li><strong>{{$company_name['value'] ?? ''}}</strong></li>
                                        <li>VAT No. 251771-601</li>
                                        <li>{{$location['value'] ?? ''}}</li>
                                        <li>{{$building['value'] ?? ''}}</li>
                                        <li>P.O.Box: {{$po_box['value'] ?? ''}}</li>
                                        <li>{{$city['value'] ?? ''}} - {{$country['value'] ?? ''}}</li>
                                        <li>Tel: {{$tel_nb['value'] ?? ''}}</li>
                                        <li>Fax: {{$fax['value'] ?? ''}}</li>
                                        <li>Email: hss@harborlbservice.com</li>
                                        <li>Website: harborlbservice.com</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 mt-2">
                                <h2 class="text-center">Disbursement Account</h2>
                            </div>
                            <div class="col-md-12 invoice-head mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <p><strong>RD/A Date:</strong> {{date("l d, Y")}}</p>
                                            <p><strong>D/A Number:</strong> {{$enquiries->da_nb}}</p>
                                            <p><strong>Transfer Reference: {{$payment_reference ?? ''}}</strong></p>
                                            <p>Customer Name: {{$trip->customer_name ?? ''}}</p>
                                            <p style="max-width: 70%;">Address: {{$trip->address ?? ''}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <p><strong>Port Call Details</strong></p>
                                            <p>Vessel: {{$trip->vessel ?? ''}}</p>
                                            <p>Port: {{$trip->port ?? ''}}</p>
                                            <p>Terminal: {{$trip->terminal ?? ''}}</p>
                                            <p>ATA: {{$trip->ata ?? ''}}</p>
                                            <p>ATS: {{$trip->ats ?? ''}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="invoice-items">
                                    <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="0">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="per50 text-center">Service Description</th>
                                                <th class="per5 text-center">Qty</th>
                                                <th class="per15 text-center">PD/A</th>
                                                <th class="per15 text-center">RD/A</th>
                                                <th class="per20 text-center">Notes</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $total1 = 0; $total2 = 0; $total3 = 0; @endphp
                                            @foreach($data as $dt)
                                                @php
                                                    $price1 = $dt[1]*$dt[2];
                                                    $total1+=$price1;
                                                    $price2 = $dt[1]*$dt[3];
                                                    $total2+=$price2;
                                                @endphp
                                                <tr>
                                                    <td>{{$dt[0]}}</td>
                                                    <td class="text-center">
                                                        @if($dt[1] == 0)
                                                            {{''}}
                                                        @else
                                                            {{number_format($dt[1], 2)}}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($dt[2] == 0)
                                                            {{''}}
                                                        @else
                                                            {{$enquiry_with_currency->currency->symbol}}{{number_format($dt[2], 2)}}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($dt[3] == 0)
                                                            {{''}}
                                                        @else
                                                            {{$enquiry_with_currency->currency->symbol}}{{number_format($dt[3], 2)}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{$dt[5]}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="2" class="text-right">Total</th>
                                                <th class="text-center">{{$enquiry_with_currency->currency->symbol}}{{number_format($total1, 2)}}</th>
                                                <th class="text-center">{{$enquiry_with_currency->currency->symbol}}{{number_format($total2, 2)}}</th>
                                                <th class="text-center"></th>
                                            </tr>
                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div>
                                    <p>{{$statement ?? ''}}</p>
                                </div>
                                <div class="invoice-footer mt25">
                                    <ul class="list-unstyled">
                                        <li><strong>Our bank details:</strong></li>
                                        <li>{{$enquiry_with_currency->bank->name ?? ''}}</li>
                                        <li>{{$enquiry_with_currency->bank->branch ?? ''}}</li>
                                        <li>Swift: {{$enquiry_with_currency->bank->swift ?? ''}}</li>
                                        <li>Bank Address: {{$enquiry_with_currency->bank->location ?? ''}}</li>
                                        <li>City: {{$enquiry_with_currency->bank->city ?? ''}}</li>
                                        <li>Country: {{$enquiry_with_currency->bank->country ?? ''}}</li>                                        <li>Account Number: {{$enquiry_with_currency->bank->account_number ?? ''}}</li>
                                        <li>IBAN: {{$enquiry_with_currency->bank->iban ?? ''}}</li>
                                        <li>Currency: {{$enquiry_with_currency->currency->code ?? ''}}</li>
                                        <li>Beneficiary Name: {{$enquiry_with_currency->bank->beneficiary_name ?? ''}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/assets/bootstrap/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="js/jsPDF/dist/jspdf.umd.js"></script>
<script>
    $('#download').click(function(){
        window.print();
    });
</script>
</body>
</html>
