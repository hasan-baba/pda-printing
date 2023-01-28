const body = document.querySelector("body"),
    modeToggle = body.querySelector(".mode-toggle");
sidebar = body.querySelector("nav");
sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}
modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})
// Active class nav menu
$(function(){
    var current_page_URL = location.href;
    $( ".menu-items .nav-links a" ).each(function() {
        if ($(this).attr("href") !== "#") {
            var target_URL = $(this).prop("href");
            if (target_URL == current_page_URL) {
                $('.menu-items .nav-links a').removeClass('active');
                $(this).addClass('active');

                if($(this).hasClass('list-group-item-action')) {
                    $(this).parent().addClass('show');
                }

                return false;
            }
        }
    });
});
// drag file logo image
function readFile(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var htmlPreview =
                '<img width="200" src="' + e.target.result + '" />' +
                '<p>' + input.files[0].name + '</p>';
            var wrapperZone = $(input).parent();
            var previewZone = $(input).parent().parent().find('.preview-zone');
            var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

            wrapperZone.removeClass('dragover');
            previewZone.removeClass('hidden');
            boxZone.empty();
            boxZone.append(htmlPreview);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$(".dropzone").change(function () {
    readFile(this);
});

$('.dropzone-wrapper').on('dragover', function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).addClass('dragover');
});

$('.dropzone-wrapper').on('dragleave', function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).removeClass('dragover');
});
$( document ).ready(function() {
    if($('nav').hasClass('close')) {
        $('.sidebar-submenu').removeClass('show');
    }
    $(document).on('click', 'i.uil.uil-bars.sidebar-toggle', function (e) {
        if($('nav').hasClass('close')) {
            $('.sidebar-submenu').removeClass('show');
        }
    });
    $(document).on('click', '.has-submenu', function (e) {
        if($('nav').hasClass('close')) {
            $('nav').removeClass('close');
        }
    });
    $('#userTable').DataTable({
        "scrollX": true
    });

    function validatePassword(pass1, pass2) {
        if(pass1 != pass2) {
            return false;
        } else {
            return true;
        }
    }
    <!-- Add User -->
    $(document).on('click', '#addNewUser', function (e) {
        e.preventDefault();
        if ($("#addUserForm")[0].checkValidity()  === false) {
            $("#addUserForm").addClass('was-validated');
        } else {
            if(validatePassword($('#create-password').val(), $('#confirm-create-password').val())) {
                $("#addUserForm").removeClass('was-validated');
                var data = $('#addUserForm').serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '/admin/user/create',
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 200) {
                            $('#userModal').modal('hide');
                            swal(response.message, {
                                icon: "success",
                            }).then((result) => {
                                location.reload();
                            })
                        } else {
                            swal({
                                title: "Error",
                                text: "Couldn't complete your request! Please try again.",
                                icon: "error",
                            })
                        }
                    }
                });
            } else {
                alert('Password does not match confirm password.');
            }
        }
    });

    <!-- Edit User -->
    $(document).on('click', '#editUser', function (e) {
        e.preventDefault();
        var id = $(this).closest("tr").find("#user_id").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: '/admin/user/'+id,
            dataType: "json",
            success: function (response) {
                $('#editUserName').val(response.user.name);
                $('#editUserEmail').val(response.user.email);
                $('#userID').val(id);
            }
        });
    });

    <!-- Update User -->
    $(document).on('click', '#updateUser', function (e) {
        e.preventDefault();
        if ($("#editUserForm")[0].checkValidity()  === false) {
            $("#editUserForm").addClass('was-validated');
        } else {
            if(validatePassword($('#editPassword').val(), $('#editConfirmPassword').val())) {
                $("#editUserForm").removeClass('was-validated');
                var id = $('#userID').val();
                var data = $('#editUserForm').serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "PUT",
                    url: '/admin/user/'+id,
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        $('#editUserForm').modal('hide');
                        swal(response.message, {
                            icon: "success",
                        }).then((result) => {
                            location.reload();
                        })
                    }
                });
            } else {
                alert('Password does not match confirm password.');
            }
        }
    });

    <!-- Delete User -->
    $(document).on('click', '#userDeleteBtn', function (e) {
        e.preventDefault();

        var user_id = $(this).closest("tr").find("#user_id").val();

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
                        "_token": $('input[name="csrf-token"]').val(),
                        "id": user_id
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "DELETE",
                        url: '/admin/user/'+user_id,
                        data: data,
                        success: function (response) {
                            if(response.status == 200) {
                                swal(response.message, {
                                    icon: "success",
                                }).then((result) => {
                                    location.reload();
                                })
                            } else {
                                swal(response.message, {
                                    icon: "error"
                                })
                            }
                        }
                    });
                }
            });
    });
});
