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
