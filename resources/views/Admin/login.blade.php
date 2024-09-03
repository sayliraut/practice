<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="{{ asset('public/assets/css/light/custom.css') }}" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/light/plugins/src/table/datatables.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/assets/css/light/plugins/src/table/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/assets/css/light/plugins/src/table/custom_dt_custom.css') }}">
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('public/assets/css/light/plugins/src/table/datatables.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.3/apexcharts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="layout-boxed">
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <div class="row w-100" style="height: 100vh;">
        <div class=" col-md-6 m-auto h-100 d-flex flex-column align-itms-center justify-content-center"
            style="background-color: #05244D;">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('public/assets/img/logo.png') }}" width="150" height="150" alt="">
            </div>
        </div>
        <div class=" col-md-6 h-100 d-flex justify-content-center align-items-center login-background-img">
            <div class="row d-flex flex-column justify-content-center align-items-center m-auto"
                style="width: 60%; z-index: 999;">
                {{-- @include('admin.layouts.messages') --}}
                {{-- <h3 class="text-start font-weight-bold mb-3 text-white">WELCOME BACK</h3> --}}
                <form id="admin_login_form">
                    @csrf
                    <div class="col-md-12">
                        <div class="mb-3 input-parent">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <input type="email" name="email" class="form-control" placeholder="Email address">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-12">
                        <div class="mb-3 input-parent">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password">
                            <i class="fa fa-eye-slash" aria-hidden="true" id="passwordToggle"></i>
                            {{-- <i class="fa-regular fa-eye-slash eye" id="passwordToggle"></i> --}}
                        </div>
                    </div>
                    <br>
                    <br>
                    {{-- <div class="col-md-12">
                            <div class="mb-3">
                                <a class="text-white" href="{{ url('/forgot_password') }}">Forgot Password?</a>
                            </div>
                        </div> --}}
                    <div class="col-md-12">
                        <div>
                            <button type="submit" id="admin_login_btn" class="p-0 download-btn"
                                class="w-100">Login</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    
    <script>
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
                    url_path = "{{ url('/') }}";

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
    </script>
</body>

</html>
