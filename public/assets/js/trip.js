$(document).ready( function () {
    $('#tripTable').DataTable({
        "scrollX": true
    });

    <!-- Add New Trip -->
    $(document).on('click', '#submit-trip', function (e) {
        e.preventDefault();
        if ($("#tripForm")[0].checkValidity()  === false) {
            $("#tripForm").addClass('was-validated');
        } else {
            $("#tripForm").removeClass('was-validated');
            // start the ajax request
            var data = $('#tripForm').serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '/admin/trip/create',
                data: data,
                success: function (response) {
                    if(response.status == 200) {
                        swal(response.message, {
                            icon: "success",
                        }).then((result) => {
                            location.reload();
                        })
                    }
                }
            });
        }
    });

    <!-- Delete Trip -->
    $(document).on('click', '#delete-trip', function (e) {
        e.preventDefault();

        var id = $(this).closest("tr").find("#trip_id").val();

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
                        url: '/admin/trip/'+id,
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
    <!-- Edit Trip Details -->
    $(document).on('click', '#edit-trip', function (e) {
        e.preventDefault();
        var trip_id = $(this).closest("tr").find("#trip_id").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: '/admin/trip/'+trip_id,
            dataType: "json",
            success: function (response) {
                $('#edit-trip-id').val(response.trips.id)
                $('#edit-customer').val(response.trips.customer_name)
                $('#edit-address').val(response.trips.address)
                $('#edit-terminal').val(response.trips.terminal)
                $('#edit-vessel').val(response.trips.vessel)
                $('#edit-port').val(response.trips.port)
                $('#edit-eta').val(response.trips.eta)
                $('#edit-ata').val(response.trips.ata)
                $('#edit-ats').val(response.trips.ats)
            }
        });
    });
    <!-- Update Trip Details -->
    $(document).on('click', '#update-trip', function (e) {
        e.preventDefault();
        var id = $('#edit-trip-id').val();
        var data = $('#editTripForm').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "PUT",
            url: '/admin/trip/'+id,
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
} );
