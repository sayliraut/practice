@extends('Admin.layouts.master')

@section('content')
    <?php $currentPage = 'sub-admins'; ?>
    <style>
        .error-message {
            color: #FF0000;
        }

        form .error-message {
            color: red;
            /* Set your desired color here */
        }

        form .input_class.error-message {
            color: #0e1726;
        }
    </style>

    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="row layout-top-spacing ">
                <div class="top-tabel">
                    <div class="row">
                        <div class="col-md-4">
                            <a class="d-flex align-items-center justify-content-center pl-2"
                                href="{{ route('manage.subAdmin') }}">
                                <img class="back-btn" src="{{ asset('public/assets/img/left-arrow.svg') }}">
                                <h6 class="card-title p-0">Add Sub Admins</h6>
                            </a>
                        </div>
                        <div class="col-md-8">

                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8 position-btn h-10">
                        <div class="view-details Article">
                            <form id="add_sub_admin_form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="company-name" class="label">First Name</label>
                                            <input type="text" class="form-control" name="sub_admin_name">
                                            <span class="error-message" id="first_name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="company-name" class="label">Email ID</label>
                                            <input type="text" class="form-control" name="sub_admin_email">
                                            <span class="error-message" id="email_error"></span>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <label class="label">Permissions</label>
                                            <label id="module_id[]-error" class="error-message" for="module_id[]"></label>
                                        </div>
                                        <div class="row">
                                            @foreach ($sub_admins_module as $sub_admins_modules)
                                                <div class="form-group subadmin-option col-md-3">
                                                    <input id="customers{{ $sub_admins_modules->id }}" type="checkbox"
                                                        name="module_id[]" class="form-control"
                                                        value="{{ $sub_admins_modules['id'] }}">
                                                    <label for="customers{{ $sub_admins_modules->id }}"
                                                        class="label mb-0">{{ $sub_admins_modules->name }}</label>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="label">Password</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button id="add_sub_admin_form_btn" type="submit"
                                            class="download-btn-custom mt-3 custom-width-10">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('section_script')
    {{-- <script src="{{ asset('public/assets/js/admin/manage_sub_admin/add.js') }}"></script> --}}
    <script>
        $(document).on("click", "#add_sub_admin_form_btn", function(e) {
            $.validator.addMethod("lettersOnly", function(value, element) {
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
                submitHandler: function(form) {
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
                        beforeSend: function() {
                            $('#add_sub_admin_form_btn').html('Please wait...');
                            $('#add_sub_admin_form_btn').attr('disabled', true);
                        },
                        processData: false,
                        contentType: false,
                        success: function(result) {
                            if (result.status_code == 200) {
                                toastr.success('Data Added Successfully');
                                setTimeout(function() {
                                    window.location.href = base_url +
                                        "/manage-sub-admin";
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
                                $.each(errors, function(key, value) {
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
    </script>
@endsection
