$(document).on("click", "#customer_user_btn", function (e) {

    // Add custom validation method for full name (alphabetic characters only)
    $.validator.addMethod("fullNameCharactersOnly", function(value, element) {
        return /^[a-zA-Z\s]+$/.test(value);
    }, "Please enter only alphabetical characters for the full name");

    $.validator.addMethod("numericCharactersOnly", function(value, element) {
        return /^[0-9]+$/.test(value);
    }, "Please enter only numeric characters");

    $('#customer_user_form').validate({
        ignore: [],
        debug: false,
        rules: {
            name: {
                required: true,
                fullNameCharactersOnly: true
            },
            email_address: {
                required: true,
                email: true,
            },
            date_of_birth: {
                required: true,
            },
            phone: {
                required: true,
                numericCharactersOnly: true
            }
        },
        messages: {
            name: {
                required: "Enter Passport Name",
                alphaCharactersOnly: "Please enter only alphabetical characters"
            },
            email_address: {
                required: "Enter email address",
                email: "Please enter a valid email address"
            },
            date_of_birth: {
                required: "Please enter date of birth",
            },
            phone: {
                required: "Enter Phone Number",
                numericCharactersOnly: "Please enter only numeric characters"
            }
        },
        errorClass: 'error-message',
        submitHandler: function(form) {
            let base_url = url_path;
            var formData = new FormData(form);

            $('#customer_user_btn').text('Please wait...');
            $('#customer_user_btn').attr('disabled', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: base_url + '/update_customer',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);

                    if (result.status_code == 200) {
                        toastr.success('Customer Updated Successfully');
                        setTimeout(function() {
                            window.location.href = base_url + "/manage-customer";
                        }, 2000);
                    } else {
                        toastr.error(result.message);
                        setTimeout(function() {
                            window.location.href = base_url + "/manage-customer";
                        }, 2000);
                    }
                    $('#customer_user_btn').attr('disabled', false);
                    $('#customer_user_btn').text('Submit');
                },
                error: function(xhr) {
                    console.log(xhr);
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                toastr.error(errors[key][0]); // Show the first error message for each field
                            }
                        }
                    } else {
                        toastr.error('Something Went Wrong');
                    }
                    $('#customer_user_btn').attr('disabled', false);
                    $('#customer_user_btn').text('Submit');
                }
            });


            $('#customer_user_btn').attr('disabled', false);
                    $('#customer_user_btn').text('Submit');
        }
    });
});



