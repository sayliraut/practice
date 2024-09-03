$('#update_admin_btn').on("click", function (e) {
    // alert('sdhjgf');
    $('#update_sub_admin').validate({
        ignore: [],
        debug: false,
        rules: {
            sub_admin_name: {
                required: true
            },
            sub_admin_lname: {
                required: true,

            },
            sub_admin_email: {
                required: true
            }
        },
        messages: {
            sub_admin_name: {
                required: 'Please enter this field'
            },
            ssub_admin_lname: {
                required: 'Please enter this field'
            },
            sub_admin_email: {
                required: 'Please enter this field'
            }
        },
        errorClass: 'error-message',
        submitHandler: function (form) {
            var formData = new FormData(form);
            let base_url = url_path;
            e.preventDefault(),
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                url: base_url + '/update_sub_admin',
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('#update_admin_btn').html('Please wait...');
                    $('#update_admin_btn').attr('disabled', true);
                },
                processData: false,
                contentType: false,
                success: function (result) {

                    if (result.status_code == 200) {
                        toastr.success('Data Updated Sucessfully');
                        setTimeout(function () {
                            window.location.href = base_url + "/manage-sub-admin";
                        }, 2000);
                    } else {
                        toastr.error('Something Went Wrong');
                        setTimeout(function () {
                            window.location.href = base_url + "/manage-sub-admin";
                        }, 2000);
                    }
                    $('#update_admin_btn').attr('disabled', false);
                    $('#update_admin_btn').text('Submit');
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        var errors = JSON.parse(xhr.responseText).errors;
                        $.each(errors, function (key, value) {
                            toastr.error(value);
                        });

                    } else {
                        toastr.error('An error occurred: ' + xhr.responseText);
                    }
                    $('#update_admin_btn').attr('disabled', false);
                    $('#update_admin_btn').text('Submit');
                }

            });

            // $('#update_admin_btn').attr('disabled', false);
            //         $('#update_admin_btn').text('Submit');
        }
    });
});
