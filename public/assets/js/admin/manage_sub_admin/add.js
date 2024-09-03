$(document).on("click", "#add_sub_admin_form_btn", function (e) {
    $.validator.addMethod("lettersOnly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Please enter alphabetic characters only");

    $('#add_sub_admin_form').validate({
        ignore: [],
        debug: false,

        rules: {
            sub_admin_name: {
                required: true,
                lettersOnly: true
            },
            sub_admin_lname: {
                required: true,
                lettersOnly: true
            },
            sub_admin_email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            "module_id[]": {
                required: true
            }
        },
        messages: {
            sub_admin_name: {
                required: 'Please enter this field',
            },
            sub_admin_lname: {
                required: 'Please enter this field',
            },
            sub_admin_email: {
                required: 'Please enter this field',
                email: 'Please enter a valid email address'
            },
            password: {
                required: 'Please enter this field',
                minlength: 'Password must be at least 8 characters long'
            },
            "module_id[]": {
                required: 'Please enter this field'
            }
        },
        errorClass: 'error-message',
        submitHandler: function (form) {
            var formData = new FormData(form);
            let base_url = url_path;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: base_url + '/insert_sub_admin',
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('#add_sub_admin_form_btn').html('Please wait...');
                    $('#add_sub_admin_form_btn').attr('disabled', true);
                },
                processData: false,
                contentType: false,
                success: function (result) {
                    if (result.status_code == 200) {
                        toastr.success('Data Added Successfully');
                        setTimeout(function () {
                            window.location.href = base_url + "/manage-sub-admin";
                        }, 2000);
                    } else {
                        toastr.error(result.messages);
                        $('#add_sub_admin_form_btn').attr('disabled', false);
                        $('#add_sub_admin_form_btn').text('Submit');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = JSON.parse(xhr.responseText).errors;
                        $.each(errors, function (key, value) {
                            toastr.error(value);
                        });

                    } else {
                        toastr.error('An error occurred: ' + xhr.responseText);
                    }
                    $('#add_sub_admin_form_btn').attr('disabled', false);
                    $('#add_sub_admin_form_btn').text('Submit');
                }
            });
        }
    });
});

