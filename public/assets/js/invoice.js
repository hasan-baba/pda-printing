var faqs_row = 9;
function addfaqs() {
    html = '<tr id="faqs-row-' + faqs_row + '">';
    html += '<td><div class="form-group"><textarea class="form-control" id="description" name="description"></textarea></div></td>';
    html += '<td><input type="number" class="form-control" id="qty" name="qty" value="1" min="1"></td>';
    html += '<td><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text change-currency">$</span></div><input type="number" id="t1" name="t1" class="form-control" min="0"></div></td>';
    html += '<td><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text change-currency">$</span></div><input type="number" id="t2" name="t2" class="form-control" min="0"></div></td>';
    html += '<td><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text change-currency">$</span></div><input type="number" id="t3" name="t3" class="form-control" min="0"></div></td>';
    html += '<td><div class="form-group"><textarea class="form-control" id="notes" name="notes"></textarea></div></td>';
    html += '<td class="mt-10"><button class="badge badge-danger" onclick="$(\'#faqs-row-' + faqs_row + '\').remove();"><i class="fa fa-trash"></i> Delete</button></td>';

    html += '</tr>';

    $('#faqs tbody').append(html);

    faqs_row++;
}
function addfaqsWithLBP() {
    html = '<tr id="faqs-row-' + faqs_row + '">';
    html += '<td><div class="form-group"><textarea class="form-control" id="description" name="description"></textarea></div></td>';
    html += '<td><input type="number" class="form-control" id="qty" name="qty" value="1" min="1"></td>';
    html += '<td><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text change-currency">$</span></div><input type="number" id="t1" name="t1" class="form-control" min="0"></div></td>';
    html += '<td><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text change-currency">$</span></div><input type="number" id="t2" name="t2" class="form-control" min="0"></div></td>';
    html += '<td><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text change-currency">$</span></div><input type="number" id="t3" name="t3" class="form-control" min="0"></div></td>';
    html += '<td><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">LBP</span></div><input type="number" id="t4" name="t4" class="form-control" min="0"></div></td>';
    html += '<td><div class="form-group"><textarea class="form-control" id="notes" name="notes"></textarea></div></td>';
    html += '<td class="mt-10"><button class="badge badge-danger" onclick="$(\'#faqs-row-' + faqs_row + '\').remove();"><i class="uil uil-trash"></i></button></td>';

    html += '</tr>';

    $('#faqs tbody').append(html);

    faqs_row++;
}
function getData() {
    var desc = document.querySelectorAll('#description');
    var desc_arr = [...desc].map(input => input.value);

    var qty = document.querySelectorAll('#qty');
    var qty_arr = [...qty].map(input => input.value);

    var t1 = document.querySelectorAll('#t1');
    var t1_arr = [...t1].map(input => input.value);

    var t2 = document.querySelectorAll('#t2');
    var t2_arr = [...t2].map(input => input.value);

    var t3 = document.querySelectorAll('#t3');
    var t3_arr = [...t3].map(input => input.value);

    var note = document.querySelectorAll('#notes');
    var note_arr = [...note].map(input => input.value);

    var data = Array ( );

    for(let i = 0; i < desc_arr.length; i++) {
        data[i] = Array(desc_arr[i], qty_arr[i], t1_arr[i], t2_arr[i], t3_arr[i], note_arr[i] );
    }
    return data;
}

function getDataWithLBP() {
    var desc = document.querySelectorAll('#description');
    var desc_arr = [...desc].map(input => input.value);

    var qty = document.querySelectorAll('#qty');
    var qty_arr = [...qty].map(input => input.value);

    var t1 = document.querySelectorAll('#t1');
    var t1_arr = [...t1].map(input => input.value);

    var t2 = document.querySelectorAll('#t2');
    var t2_arr = [...t2].map(input => input.value);

    var t3 = document.querySelectorAll('#t3');
    var t3_arr = [...t3].map(input => input.value);

    var t4 = document.querySelectorAll('#t4');
    var t4_arr = [...t4].map(input => input.value);

    var note = document.querySelectorAll('#notes');
    var note_arr = [...note].map(input => input.value);

    var data = Array ( );

    for(let i = 0; i < desc_arr.length; i++) {
        data[i] = Array(desc_arr[i], qty_arr[i], t1_arr[i], t2_arr[i], t3_arr[i], t4_arr[i], note_arr[i] );
    }
    return data;
}

// get total
function getTotal(totalID, nbCell) {
    var total = 0, price;
    for (var a = document.querySelectorAll('table#faqs tbody tr'), i = 0; a[i]; ++i) {
        cells = a[i].querySelectorAll('td');
        price = parseInt($(cells[1]).find('#qty').val())* $(cells[nbCell]).children('').children('input').val();
        total += price;
    }
    return total;
}
// international enquiries
$(document).ready( function () {
    <!-- Add / Update Enquiry -->
    $(document).on('click', '#save-enquiry', function (e) {
        e.preventDefault();
        var data = getData();
        var trip_id = $('#trip_id').val();
        var status = $('#status_selection').val();
        var advanced_payment = $('#advanced_payment').val();
        var payment_reference = $('#payment_reference').val();
        var statement = $('#statement').val();
        var currency = $('#currency').val();
        var bank = $('#bank').val();
        if(bank == 0) {
            bank = null;
        }
        // start the ajax request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/admin/enquiry/create',
            dataType: 'json',
            data: {data: data, trip_id: trip_id, status: status, advanced_payment: advanced_payment, payment_reference: payment_reference, statement: statement, currency: currency, bank: bank},
            success: function (response) {
                if (response.status == 200) {
                    swal(response.message, {
                        icon: "success",
                    }).then((result) => {
                        location.reload();
                    })
                }
            }
        });
    });
    // save and download all cost
    $(document).on('click', '#download-enquiry', function (e) {
        e.preventDefault();
        var data = getData();
        var trip_id = $('#trip_id').val();
        var status = $('#status_selection').val();
        var advanced_payment = $('#advanced_payment').val();
        var payment_reference = $('#payment_reference').val();
        var statement = $('#statement').val();
        var currency = $('#currency').val();
        var bank = $('#bank').val();
        if(bank == 0) {
            bank = null;
        }
        // start the ajax request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/admin/enquiry/create',
            dataType: 'json',
            data: {data: data, trip_id: trip_id, status: status, advanced_payment: advanced_payment, payment_reference: payment_reference, statement: statement, currency: currency, bank: bank},
            success: function (response) {
                if (response.status == 200) {
                    window.open('/admin/enquiry/download/'+trip_id, '_blank');
                }
            }
        });
    });

    // save and download pdf estimated cost
    $(document).on('click', '#estimated-enquiry', function (e) {
        e.preventDefault();
        var data = getData();
        var trip_id = $('#trip_id').val();
        var status = $('#status_selection').val();
        var advanced_payment = $('#advanced_payment').val();
        var payment_reference = $('#payment_reference').val();
        var statement = $('#statement').val();
        var currency = $('#currency').val();
        var bank = $('#bank').val();
        if(bank == 0) {
            bank = null;
        }
        // start the ajax request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/admin/enquiry/create',
            dataType: 'json',
            data: {data: data, trip_id: trip_id, status: status, advanced_payment: advanced_payment, payment_reference: payment_reference, statement: statement, currency: currency, bank: bank},
            success: function (response) {
                if (response.status == 200) {
                    window.open('/admin/enquiry/download-1/'+trip_id, '_blank');
                }
            }
        });
    });

    // save and download pdf departure cost
    $(document).on('click', '#departure-enquiry', function (e) {
        e.preventDefault();
        var data = getData();
        var trip_id = $('#trip_id').val();
        var status = $('#status_selection').val();
        var advanced_payment = $('#advanced_payment').val();
        var payment_reference = $('#payment_reference').val();
        var statement = $('#statement').val();
        var currency = $('#currency').val();
        var bank = $('#bank').val();
        if(bank == 0) {
            bank = null;
        }
        // start the ajax request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/admin/enquiry/create',
            dataType: 'json',
            data: {data: data, trip_id: trip_id, status: status, advanced_payment: advanced_payment, payment_reference: payment_reference, statement: statement, currency: currency, bank: bank},
            success: function (response) {
                if (response.status == 200) {
                    window.open('/admin/enquiry/download-2/'+trip_id, '_blank');
                }
            }
        });
    });

    var url = window.location.pathname;
    if(url.indexOf('/admin/enquiry/') > -1) {
        document.querySelector('#total_exp1').value = getTotal('t1', 2);
        document.querySelector('#total_exp2').value = getTotal('t2', 3);
        document.querySelector('#total_exp3').value = getTotal('t3', 4);
        document.querySelector('#remaining_balance').value = getTotal('t3', 4) - $('#advanced_payment').val();
    }

    $(document).on('change', 'input', function() {
        document.querySelector('#total_exp1').value = getTotal('t1', 2);
        document.querySelector('#total_exp2').value = getTotal('t2', 3);
        document.querySelector('#total_exp3').value = getTotal('t3', 4);
        document.querySelector('#remaining_balance').value = getTotal('t3', 4) - $('#advanced_payment').val();
    });
});
// lebanese enquiries
$(document).ready( function () {
    <!-- Add / Update Enquiry -->
    $(document).on('click', '#save-lb-enquiry', function (e) {
        e.preventDefault();
        var data = getDataWithLBP();
        var trip_id = $('#trip_id').val();
        var status = $('#status_selection').val();
        var advanced_payment = $('#advanced_payment').val();
        var payment_reference = $('#payment_reference').val();
        var advanced_payment_lb = $('#advanced_payment_lb').val();
        var payment_reference_lb = $('#payment_reference_lb').val();
        var statement = $('#statement').val();
        var currency = $('#currency').val();
        var bank = $('#bank').val();
        if(bank == 0) {
            bank = null;
        }
        // start the ajax request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/admin/lb-enquiry/create',
            dataType: 'json',
            data: {data: data, trip_id: trip_id, status: status, advanced_payment: advanced_payment, payment_reference: payment_reference, advanced_payment_lb: advanced_payment_lb, payment_reference_lb: payment_reference_lb, statement: statement, currency: currency, bank: bank},
            success: function (response) {
                if (response.status == 200) {
                    swal(response.message, {
                        icon: "success",
                    }).then((result) => {
                        location.reload();
                    })
                }
            }
        });
    });
    // save and download all cost
    $(document).on('click', '#download-lb-enquiry', function (e) {
        e.preventDefault();
        var data = getDataWithLBP();
        var trip_id = $('#trip_id').val();
        var status = $('#status_selection').val();
        var advanced_payment = $('#advanced_payment').val();
        var payment_reference = $('#payment_reference').val();
        var advanced_payment_lb = $('#advanced_payment_lb').val();
        var payment_reference_lb = $('#payment_reference_lb').val();
        var statement = $('#statement').val();
        var currency = $('#currency').val();
        var bank = $('#bank').val();
        if(bank == 0) {
            bank = null;
        }
        // start the ajax request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/admin/lb-enquiry/create',
            dataType: 'json',
            data: {data: data, trip_id: trip_id, status: status, advanced_payment: advanced_payment, payment_reference: payment_reference, advanced_payment_lb: advanced_payment_lb, payment_reference_lb: payment_reference_lb, statement: statement, currency: currency, bank: bank},
            success: function (response) {
                if (response.status == 200) {
                    window.open('/admin/lb-enquiry/download/'+trip_id, '_blank');
                }
            }
        });
    });

    // save and download pdf estimated cost
    $(document).on('click', '#estimated-lb-enquiry', function (e) {
        e.preventDefault();
        var data = getDataWithLBP();
        var trip_id = $('#trip_id').val();
        var status = $('#status_selection').val();
        var advanced_payment = $('#advanced_payment').val();
        var payment_reference = $('#payment_reference').val();
        var advanced_payment_lb = $('#advanced_payment_lb').val();
        var payment_reference_lb = $('#payment_reference_lb').val();
        var statement = $('#statement').val();
        var currency = $('#currency').val();
        var bank = $('#bank').val();
        if(bank == 0) {
            bank = null;
        }
        // start the ajax request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/admin/lb-enquiry/create',
            dataType: 'json',
            data: {data: data, trip_id: trip_id, status: status, advanced_payment: advanced_payment, payment_reference: payment_reference, advanced_payment_lb: advanced_payment_lb, payment_reference_lb: payment_reference_lb, statement: statement, currency: currency, bank: bank},
            success: function (response) {
                if (response.status == 200) {
                    window.open('/admin/lb-enquiry/download-1/'+trip_id, '_blank');
                }
            }
        });
    });

    // save and download pdf departure cost
    $(document).on('click', '#departure-lb-enquiry', function (e) {
        e.preventDefault();
        var data = getDataWithLBP();
        var trip_id = $('#trip_id').val();
        var status = $('#status_selection').val();
        var advanced_payment = $('#advanced_payment').val();
        var payment_reference = $('#payment_reference').val();
        var advanced_payment_lb = $('#advanced_payment_lb').val();
        var payment_reference_lb = $('#payment_reference_lb').val();
        var statement = $('#statement').val();
        var currency = $('#currency').val();
        var bank = $('#bank').val();
        if(bank == 0) {
            bank = null;
        }
        // start the ajax request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/admin/lb-enquiry/create',
            dataType: 'json',
            data: {data: data, trip_id: trip_id, status: status, advanced_payment: advanced_payment, payment_reference: payment_reference, advanced_payment_lb: advanced_payment_lb, payment_reference_lb: payment_reference_lb, statement: statement, currency: currency, bank: bank},
            success: function (response) {
                if (response.status == 200) {
                    window.open('/admin/lb-enquiry/download-2/'+trip_id, '_blank');
                }
            }
        });
    });

    var url = window.location.pathname;
    if(url.indexOf('/admin/lb-enquiry/') > -1) {
        document.querySelector('#total_exp1').value = getTotal('t1', 2);
        document.querySelector('#total_exp2').value = getTotal('t2', 3);
        document.querySelector('#total_exp3').value = getTotal('t3', 4);
        document.querySelector('#total_exp4').value = getTotal('t4', 5);
        document.querySelector('#remaining_balance').value = getTotal('t3', 4) - $('#advanced_payment').val();
        document.querySelector('#remaining_balance_lb').value = getTotal('t4', 5) - $('#advanced_payment_lb').val();
    }

    $(document).on('change', 'input', function() {
        document.querySelector('#total_exp1').value = getTotal('t1', 2);
        document.querySelector('#total_exp2').value = getTotal('t2', 3);
        document.querySelector('#total_exp3').value = getTotal('t3', 4);
        document.querySelector('#total_exp4').value = getTotal('t4', 5);
        document.querySelector('#remaining_balance').value = getTotal('t3', 4) - $('#advanced_payment').val();
        document.querySelector('#remaining_balance_lb').value = getTotal('t4', 5) - $('#advanced_payment_lb').val();
    });
});
