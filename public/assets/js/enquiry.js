$(document).ready( function () {
    $('#enquiryTable').DataTable({
        "scrollX": true
    });
    $('#lbEnquiryTable').DataTable({
        "scrollX": true
    });

    var url = window.location.pathname;
    if(url.indexOf('/admin/enquiry/') > -1 || url.indexOf('/admin/lb-enquiry/') > -1) {
        var selected_currency = $( "#currency option:selected" ).text();
        var arr = selected_currency.split(' ');
        $('.change-currency').text(arr[1]);
    }
    if(url.indexOf('/admin/report') > -1) {
        $('#reportTable').DataTable({
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf'
            ]
        });

        // Custom filtering function
        var min, max;
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                if($('#min').val() == '') {
                    min = new Date('01/01/1970');
                } else {
                    min = new Date($('#min').val());
                }
                if($('#max').val() == '') {
                    var d = new Date();
                    var year = d.getFullYear();
                    var month = d.getMonth();
                    var day = d.getDate();
                    max = new Date(year + 20, month, day);
                } else {
                    max = new Date($('#max').val());
                }
                var date = new Date( data[2] );

                if (
                    ( min === null && max === null ) ||
                    ( min === null && date <= max ) ||
                    ( min <= date   && max === null ) ||
                    ( min <= date   && date <= max )
                ) {
                    return true;
                }
                return false;
            }
        );

        // DataTables initialisation
        var table = $('#reportTable').DataTable();

        // Refilter the table
        $('#min, #max').on('change', function () {
            table.draw();
        });

        // filter status
        $("#filterTable_filter.dataTables_filter").append($("#categoryFilter"));

        var categoryIndex = 3;
        $("#reportTable th").each(function (i) {
            if ($($(this)).html() == "Enquiry Status") {
                categoryIndex = i; return false;
            }
        });

        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var selectedItem = $('#categoryFilter').val()
                var category = data[categoryIndex];
                if (selectedItem === "" || category.includes(selectedItem)) {
                    return true;
                }
                return false;
            }
        );

        $("#categoryFilter").change(function (e) {
            table.draw();
        });
    }

    // status enquiry update
    // $( "#status_selection" ).change(function() {
    //     var trip_id = $('#trip_id').val();
    //     var status =  $(this).val();
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         type: "POST",
    //         url: '/admin/enquiry/update_status',
    //         data: {
    //             trip_id:trip_id,
    //             status:status
    //         },
    //         success: function (response) {
    //             if(response.status == 200) {
    //                 swal(response.message, {
    //                     icon: "success",
    //                 }).then((result) => {
    //                     // location.reload();
    //                 })
    //             }
    //         }
    //     });
    // });

    // currency enquiry update
    $( "#currency" ).change(function() {
        var selected_currency = $( "#currency option:selected" ).text();
        var arr = selected_currency.split(' ');
        $('.change-currency').text(arr[1]);
        var trip_id = $('#trip_id').val();
        var currency =  $(this).val();
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //     type: "POST",
        //     url: '/admin/enquiry/update_currency',
        //     data: {
        //         trip_id:trip_id,
        //         currency:currency
        //     },
        //     success: function (response) {
        //         if(response.status == 200) {
        //             swal(response.message, {
        //                 icon: "success",
        //             }).then((result) => {
        //                 // location.reload();
        //             })
        //         }
        //     }
        // });
    });

    // bank enquiry update
    // $( "#bank" ).change(function() {
    //     var trip_id = $('#trip_id').val();
    //     var bank =  $(this).val();
    //     if(bank == 0) {
    //         bank = null;
    //     }
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         type: "POST",
    //         url: '/admin/enquiry/update_bank',
    //         data: {
    //             trip_id:trip_id,
    //             bank:bank
    //         },
    //         success: function (response) {
    //             if(response.status == 200) {
    //                 swal(response.message, {
    //                     icon: "success",
    //                 }).then((result) => {
    //                     // location.reload();
    //                 })
    //             }
    //         }
    //     });
    // });
});
