// Login js
$(document).on("click", "#admin_login_btn", function(e) {
    $('#admin_login_form').validate({
        rules: {
            email: {
                required: true,
            },
            password: {
                required: true,
            }
        },
        messages: {
            email: {
                required: "Please enter the email address.",
            },
            password: {
                required: "Please enter the password.",
            }
        },
        submitHandler: function(form) {
            e.preventDefault();
            let base_url = url_path;
            var formData = new FormData(form);
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                url: base_url + '/check_login',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('#admin_login_btn').text('Please wait...');
                    $('#admin_login_btn').attr('disabled', true);
                },
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    $('#admin_login_btn').prop('disabled', false);
                    $('#admin_login_btn').text('Login');

                    if (response.status_code == 200) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = base_url + "/dashboard";
                        }, 2000);
                    } else if (response.status_code == 401) {
                        toastr.error(response.message);
                        form.reset();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('An unexpected error occurred.');
                    $('#admin_login_btn').prop('disabled', false);
                    $('#admin_login_btn').text('Sign In');
                }
            });
        }
    });
});

// forgot password js
$(document).on("click", "#forgot_password_btn", function (e) {
    let base_url = url_path;
    $('#forgot_pass_form').validate({
        ignore: [],
        debug: false,
        rules: {
            email: {
                required: true
            }
        },
        messages: {
            email: {
                required: "Please Enter email"
            }
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            e.preventDefault(),
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                    });
            $.ajax({
                url: base_url + '/send_otp',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    if (response.status_code == 200) {
                        form.reset();
                        toastr.success('An OTP has been sent to your email address');
                            setTimeout(function() {
                            window.location.href = base_url + "/otp";
                                }, 2000);
                    }else if (response.status == 404) {
                        toastr.error('This email id is not exits');
                    }
                    else {
                        toastr.error(response.message);
                    }
                },
            });
        }
    });
});
// otp varification
$(document).on('click', '#otp_verify_button', function(e) {
    e.preventDefault();

    // Get base URL
    let base_url = url_path;

    // Get admin ID
    var id = $('#admin_otp_id').val();

    // Get OTP by concatenating values of all OTP input fields
    var otp = $('.otp').map(function() {
        return this.value;
    }).get().join('');

    if (otp === '') {
        toastr.error('Please enter OTP');
        return;
    }
    // Send AJAX request for OTP verification
    $.ajax({
        url: base_url + '/otp_verify',
        type: 'POST',
        data: {
            id: id,
            otp: otp,
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.status_code == 200) {
                // Display success message
                toastr.success('Otp Verify Successfully');
                // Redirect to the dashboard after a delay
                setTimeout(function () {
                    window.location.href = base_url + "/password_reset";
                }, 1000);
            } else if (response.status == 401) {
                toastr.error(response.message);
            } else {
                toastr.error(response.message);
            }
        },
    });
});

$(document).on('input', '.otp', function() {
    this.value = this.value.replace(/[^0-9]/g, '');

    if (this.value.length >= this.maxLength) {
        $(this).next('.otp').focus();
    }
});

// Reset Password
$(document).on("click", "#password_reset", function (e) {
    $("#password_reset_form").validate({
        rules: {
            password: {
                required: true,
                minlength: 8,
            },
            confirm_password: {
                required: true,
                equalTo: "#password",
            },
        },
        messages: {
            password: {
                required: "Please enter a password.",
                minlength: "The password field must be at least 8 characters.",
            },
            confirm_password: {
                required: "Please Confirm Your Password",
                equalTo: "Your Password Do Not Match",
            },
        },
        submitHandler: function (form) {
            e.preventDefault();
            let base_url = url_path;
            var formData = new FormData(form);

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                url: base_url + "/password_update",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status_code == 200) {
                        $("#password_reset").prop("disabled", false);
                        $("#password_reset").text("Login");
                        toastr.success(response.message);
                        setTimeout(function () {
                            window.location.href = base_url + "/";
                        }, 1000);
                    }
                    if (response.status_code == 401) {
                        toastr.error(response.message);
                        form.reset();
                        $("#password_reset").prop("disabled", false);
                        $("#password_reset").text("Sign In");
                    }
                },
            });
        },
    });
});

$('#passwordToggle').click(function() {
    var passwordInput = $('#password');
    var eyeIcon = $('#passwordToggle');

    if (passwordInput.attr('type') === 'password') {
        passwordInput.attr('type', 'text');
        eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
    } else {
        passwordInput.attr('type', 'password');
        eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
    }
});


document.getElementById('togglePassword').addEventListener('click', function() {
    var passwordField = document.getElementById('password');
    var icon = document.getElementById('togglePassword');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
});

document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
    var confirmPasswordField = document.getElementById('confirm_password');
    var icon = document.getElementById('toggleConfirmPassword');
    if (confirmPasswordField.type === 'password') {
        confirmPasswordField.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        confirmPasswordField.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
});
