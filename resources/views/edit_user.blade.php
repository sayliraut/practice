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


</head>


<body>
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="row layout-top-spacing ">
                <div class="top-tabel">
                    <div class="row">
                        <div class="col-md-4">
                            <a class="d-flex align-items-center justify-content-center pl-2" href="">
                                <img class="back-btn" src="{{ asset('public/assets/css/light/img/left-arrow.svg') }}">
                                <h6 class="card-title p-0">Edit User</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container">

                    <form enctype="multipart/form-data" id="edit-user-form">
                        <input type="hidden" name="customer_id" class="form-control" value="{{ $user->id }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" class="form-control" value="{{ $user->date_of_birth }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state_xid">State</label>
                            <select name="state_xid" id="stateSelect" class="form-control" required>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        {{ $user->state_xid == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city_xid">City</label>
                            <select name="city_xid" id="citySelect" class="form-control" required>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ $user->city_xid == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label">Profile Image</label>
                            <div>
                                <input type="file" class="form-control" accept="image/*" name="image"
                                    id="selectImage">
                                <img id="preview" src="#" alt="your image" class="mt-3"
                                    style="display:none;width:20%;" />
                            </div>
                            @if ($user->profile_photo)
                                <img src="{{ asset('storage/app/public/' . $user->profile_photo) }}"
                                    alt="Profile Image" style="width: 100px; height: auto;">
                            @endif

                            <div class="error-message"></div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="skills">Skills</label>
                                <select name="skills[]" class="form-control select2" multiple="multiple"
                                    style="width:300" required>
                                    @foreach ($allSkills as $skill)
                                        <option value="{{ $skill->id }}"
                                            {{ in_array($skill->id, $skills->pluck('skill_id')->toArray()) ? 'selected' : '' }}>
                                            {{ $skill->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Education</label>
                            <div id="education-fields">
                                @foreach ($educations as $education)
                                    <div class="education-row">
                                        <input type="text" name="education_title[]" class="form-control mb-2"
                                            value="{{ $education->education }}" placeholder="Education Title"
                                            required>
                                        <input type="text" name="year_of_completion[]" class="form-control mb-2"
                                            value="{{ $education->year_of_completion }}"
                                            placeholder="Year of Completion" required>
                                        <button type="button" class="btn btn-danger remove-education">Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-education" class="btn btn-primary">Add Education</button>
                        </div>
                        <div class="form-group">
                            <label for="certificates">Certificates</label>
                            <input type="file" name="certificates[]" class="form-control" multiple><br><br>
                            @if ($uploadCerticates)
                                <ul>
                                    @foreach ($uploadCerticates as $certificate)
                                        <li>{{ $certificate->certificate_path }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="profession">Profession</label><br>
                            <input type="radio" name="profession" value="Salaried"
                                {{ $professionDetail->profession == 'Salaried' ? 'checked' : '' }}> Salaried
                            <input type="radio" name="profession" value="Self-employed"
                                {{ $professionDetail->profession == 'Self-employed' ? 'checked' : '' }}> Self-employed
                        </div>
                        <div id="salaried-fields"
                            style="{{ $professionDetail->profession == 'Salaried' ? '' : 'display: none;' }}">
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" class="form-control"
                                    value="{{ $professionDetail->company_name }}">
                            </div>
                            <div class="form-group">
                                <label for="job_started_from">Job Started From</label>
                                <input type="date" name="job_started_from" class="form-control"
                                    value="{{ $professionDetail->job_started_from }}">
                            </div>
                        </div>

                        <div id="self-employed-fields"
                            style="{{ $professionDetail->profession == 'Self-employed' ? '' : 'display: none;' }}">
                            <div class="form-group">
                                <label for="business_name">Business Name</label>
                                <input type="text" name="business_name" class="form-control"
                                    value="{{ $professionDetail->business_name }}">
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" name="location" class="form-control"
                                    value="{{ $professionDetail->business_location }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email ID</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ $user->email_address }}" required>
                        </div>

                        <div class="form-group">
                            <label for="mobile">Mobile No</label>
                            <input type="text" name="mobile" class="form-control"
                                value="{{ $user->phone_number }}" required>
                        </div>

                        <button type="submit" id="update_user_details" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <script>
                    $(document).on("click", "#update_user_details", function(e) {
                        $('#edit-user-form').validate({
                            errorClass: 'error-message',
                            rules: {
                                name: {
                                    required: true
                                },
                                dob: {
                                    required: true,
                                    date: true
                                },
                                gender: {
                                    required: true
                                },
                                state_xid: {
                                    required: true
                                },
                                city_xid: {
                                    required: true
                                },
                                // image: {
                                //     required: true,
                                //     accept: "image/*"
                                // },
                                'education_title[]': {
                                    required: true
                                },
                                'year_of_completion[]': {
                                    required: true,
                                    digits: true,
                                    minlength: 4,
                                    maxlength: 4
                                },
                                'skills[]': {
                                    required: true
                                },
                                // 'certificates[]': {
                                //     required: true
                                // },
                                profession: {
                                    required: true
                                },
                                company_name: {
                                    required: function() {
                                        return $('input[name="profession"]:checked').val() === 'salaried';
                                    }
                                },
                                job_started_from: {
                                    required: function() {
                                        return $('input[name="profession"]:checked').val() === 'salaried';
                                    },
                                    date: true
                                },
                                business_name: {
                                    required: function() {
                                        return $('input[name="profession"]:checked').val() === 'self-employed';
                                    }
                                },
                                location: {
                                    required: function() {
                                        return $('input[name="profession"]:checked').val() === 'self-employed';
                                    }
                                },
                                email: {
                                    required: true,
                                    email: true
                                },
                                mobile: {
                                    required: true,
                                    digits: true,
                                    minlength: 10,
                                    maxlength: 15
                                }
                            },
                            messages: {
                                name: "Please enter your name",
                                dob: "Please enter your date of birth",
                                gender: "Please select your gender",
                                state_xid: "Please select a state",
                                city_xid: "Please select a city",
                                // image: "Please upload a profile image",
                                'education_title[]': "Please enter education details",
                                'year_of_completion[]': "Please enter the year of completion (4 digits)",
                                'skills[]': "Please select your skills",
                                // 'certificates[]': "Please upload your certificates",
                                profession: "Please select your profession",
                                company_name: "Please enter your company name",
                                job_started_from: "Please enter the job start date",
                                business_name: "Please enter your business name",
                                location: "Please enter your business location",
                                email: "Please enter a valid email address",
                                mobile: "Please enter a valid mobile number"
                            },
                            // errorPlacement: function(error, element) {
                            //     error.insertAfter(element);
                            // },
                            submitHandler: function(form) {
                                var url_path = "{{ url('/') }}";
                                let base_url = url_path;
                                var formData = new FormData(form);

                                $('#update_user_details').text('Please wait...');
                                $('#update_user_details').attr('disabled', true);

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    url: base_url + '/update_user',
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(result) {
                                        console.log(result);

                                        if (result.status_code == 200) {
                                            toastr.success('User Updated Successfully');
                                            setTimeout(function() {
                                                window.location.href = base_url +
                                                    "/";
                                            }, 2000);
                                        } else {
                                            toastr.error(result.message);
                                            setTimeout(function() {
                                                window.location.href = base_url +
                                                    "/";
                                            }, 2000);
                                        }
                                        $('#update_user_details').attr('disabled', false);
                                        $('#update_user_details').text('Submit');
                                    },
                                    error: function(xhr) {
                                        console.log(xhr);
                                        if (xhr.status === 422) {
                                            var errors = xhr.responseJSON.errors;
                                            for (var key in errors) {
                                                if (errors.hasOwnProperty(key)) {
                                                    toastr.error(errors[key][
                                                        0
                                                    ]);
                                                }
                                            }
                                        } else {
                                            toastr.error('Something Went Wrong');
                                        }
                                        $('#update_user_details').attr('disabled', false);
                                        $('#update_user_details').text('Submit');
                                    }
                                });


                                $('#update_user_details').attr('disabled', false);
                                $('#update_user_details').text('Submit');
                            }
                        });
                    });


                    $(document).ready(function() {
                        $('.select2').select2();


                        $('input[name="profession"]').change(function() {
                            if ($(this).val() == 'Salaried') {
                                $('#salaried-fields').show();
                                $('#self-employed-fields').hide();

                                // Enable salaried fields and disable self-employed fields
                                $('#salaried-fields').find('input').prop('disabled', false);
                                $('#self-employed-fields').find('input').prop('disabled', true);
                            } else if ($(this).val() == 'Self-employed') {
                                $('#salaried-fields').hide();
                                $('#self-employed-fields').show();

                                // Enable self-employed fields and disable salaried fields
                                $('#salaried-fields').find('input').prop('disabled', true);
                                $('#self-employed-fields').find('input').prop('disabled', false);
                            }
                        });

                        // Trigger change event on page load to ensure correct fields are enabled/disabled
                        $('input[name="profession"]:checked').trigger('change');


                        // Add new education fields
                        $('#add-education').click(function() {
                            var educationHtml = `<div class="education-row">
                                    <input type="text" name="education_title[]" class="form-control mb-2" placeholder="Education Title" required>
                                    <input type="text" name="year_of_completion[]" class="form-control mb-2" placeholder="Year of Completion" required>
                                    <button type="button" class="btn btn-danger remove-education">Remove</button>
                                </div>`;
                            $('#education-fields').append(educationHtml);
                        });

                        // Remove education fields
                        $(document).on('click', '.remove-education', function() {
                            $(this).closest('.education-row').remove();
                        });
                    });

                    $(document).ready(function() {
                        $('#stateSelect').on('change', function() {
                            let stateId = $(this).val();
                            let citySelect = $('#citySelect');
                            url_path = "{{ url('/') }}";

                            let base_url = url_path;


                            if (stateId) {
                                $.ajax({
                                    url: base_url + '/get-cities/' + stateId,

                                    method: 'GET',
                                    success: function(data) {
                                        citySelect.html('<option value="">Select City</option>');
                                        $.each(data, function(index, city) {
                                            citySelect.append(
                                                `<option value="${city.id}">${city.name}</option>`
                                            );
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error fetching cities:', error);
                                    }
                                });
                            } else {
                                citySelect.html('<option value="">Select City</option>');
                            }
                        });
                    });

                    document.getElementById('selectImage').onchange = function(evt) {
                        const preview = document.getElementById('preview');
                        const [file] = this.files;

                        if (file) {
                            // Hide the existing profile image if a new image is selected
                            const existingImage = document.querySelector('img[src*="{{ asset('storage/app/public/') }}"]');
                            if (existingImage) {
                                existingImage.style.display = 'none';
                            }

                            preview.style.display = 'block';
                            preview.src = URL.createObjectURL(file);
                        }
                    };
                </script>

</body>

</html>
