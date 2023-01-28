$(document).ready(function() {
    $('#bankTable').DataTable({
        scrollX: true,
    });
    <!-- Add Bank -->
    $(document).on('click', '#add_bank', function (e) {
        e.preventDefault();
        let data = new FormData($('#bankForm')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/admin/bank/create',
            data: data,
            contentType: false,
            processData: false,
            success: function (response) {
                if(response.status == 200) {
                    swal(response.message, {
                        icon: "success",
                    }).then((result) => {
                        location.reload();
                    })
                }else if(response.status == 500) {
                    swal(response.message, {
                        icon: "error",
                    })
                }
            }
        });
    });
    <!-- Delete Bank -->
    $(document).on('click', '#delete-bank', function (e) {
        e.preventDefault();
        var id = $(this).closest("tr").find("#bank_id").val();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            buttons: ['Cancel', 'Delete'],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var data = {
                        "id": id
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "DELETE",
                        url: '/admin/bank/'+id,
                        data: data,
                        success: function (response) {
                            swal(response.status, {
                                icon: "success",
                            }).then((result) => {
                                location.reload();
                            })
                        }
                    });
                }
            });
    });
    <!-- Edit Bank Details -->
    $(document).on('click', '#edit-bank', function (e) {
        e.preventDefault();
        var bank_id = $(this).closest("tr").find("#bank_id").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: '/admin/bank/'+bank_id,
            dataType: "json",
            success: function (response) {
                $('#edit_bank_id').val(response.bank.id)
                $('#bank_name').val(response.bank.name)
                $('#branch').val(response.bank.branch)
                $('#swift').val(response.bank.swift)
                $('#bank_location').val(response.bank.location)
                $('#city').val(response.bank.city)
                $('#country').val(response.bank.country)
                $('#account_nb').val(response.bank.account_number)
                $('#iban').val(response.bank.iban)
                $('#currency').val(response.bank.currency)
                $('#beneficiary_name').val(response.bank.beneficiary_name)
            }
        });
    });
    <!-- Update Bank Details -->
    $(document).on('click', '#update_bank', function (e) {
        e.preventDefault();
        var id = $('#edit_bank_id').val();
        var data = $('#bankEditForm').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "PUT",
            url: '/admin/bank/'+id,
            data: data,
            dataType: "json",
            success: function (response) {
                $('#tripModal').modal('hide');
                if(response.status == 200) {
                    swal(response.message, {
                        icon: "success",
                    }).then((result) => {
                        location.reload();
                    })
                } else if(response.status == 500) {
                    swal(response.message, {
                        icon: "error",
                    })
                }
            }
        });
    });
    <!-- Save Settings -->
    $(document).on('click', '#setting-btn', function (e) {
        e.preventDefault();
        let form = new FormData($('#setting-form')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/admin/setting/create',
            data: form,
            contentType: false,
            processData: false,
            success: function (response) {
                if(response.status == 200) {
                    swal(response.message, {
                        icon: "success",
                    }).then((result) => {
                        location.reload();
                    })
                }else if(response.status == 500) {
                    swal(response.message, {
                        icon: "error",
                    })
                }
            }
        });
    });
} );
