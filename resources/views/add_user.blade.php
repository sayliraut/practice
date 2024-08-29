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
                                <h6 class="card-title p-0">Add Details</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-8 position-btn h-10">
                        <div class="view-details Article">
                            <form id="update_restaurant_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company-name" class="label">User Name</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company-name" class="label">Date of Birth</label>
                                            <input type="date" class="form-control" name="dob">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company-name" class="label">Select Gender</label><br>
                                            <input type="radio" id="male" name="gender" value="male">
                                            <label for="male">Male</label><br>
                                            <input type="radio" id="female" name="gender" value="female">
                                            <label for="female">Female</label><br>
                                            <input type="radio" id="other" name="gender" value="other">
                                            <label for="other">Other</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location" class="label">Select State</label>
                                            <select class="form-select" id="stateSelect" name="state_xid">
                                                <option value="">Select State</option>
                                                @foreach ($state as $states)
                                                    <option value="{{ $states['id'] }}">{{ $states['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city" class="label">Select City</label>
                                            <select class="form-select" id="citySelect" name="city_xid">
                                                <option value="">Select City</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label">Profile Image</label>
                                            <div class="">
                                                <input type="file" class="form-control" accept="image/*"
                                                    name="image" id="selectImage" required>
                                                <img id="preview" src="#" alt="your image" class="mt-3"
                                                    style="display:none;width:20%;" />
                                            </div>
                                            <div class="error-message"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="educationDetails" class="label">Education Details</label>
                                            <div id="education-container">
                                                <div class="row education-entry">
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control"
                                                            name="education_title[]" placeholder="Education">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control"
                                                            name="year_of_completion[]"
                                                            placeholder="Year Of Completion">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button"
                                                            class="btn btn-success add-education">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="skills" class="label">Skills</label>
                                            <select class="form-control select2" id="skills" name="skills[]"
                                                multiple="multiple">
                                                @foreach ($skill as $skills)
                                                    <option value="{{ $skills['id'] }}">{{ $skills['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certificates" class="label">Upload Certificates</label>
                                            <input type="file" class="form-control" id="certificates"
                                                name="certificates[]" multiple>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profession" class="label">Profession</label><br>
                                            <input type="radio" id="salaried" name="profession" value="salaried">
                                            <label for="salaried">Salaried</label><br>
                                            <input type="radio" id="self-employed" name="profession"
                                                value="self-employed">
                                            <label for="self-employed">Self-employed</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="salaried-fields" style="display:none;">
                                        <div class="form-group">
                                            <label for="company-name" class="label">Company Name</label>
                                            <input type="text" class="form-control" id="company-name"
                                                name="company_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="job-started" class="label">Job Started From</label>
                                            <input type="date" class="form-control" id="job-started"
                                                name="job_started_from">
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="self-employed-fields" style="display:none;">
                                        <div class="form-group">
                                            <label for="business-name" class="label">Business Name</label>
                                            <input type="text" class="form-control" id="business-name"
                                                name="business_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="location" class="label">Location</label>
                                            <input type="text" class="form-control" id="location"
                                                name="location">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="label">Email ID</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile" class="label">Mobile No</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile"
                                                maxlength="15" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button id="update_user_btn" type="submit"
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
    <script>
        url_path = "{{ url('/') }}";
    </script>

    <script src="{{ asset('public/assets/js/admin/add.js') }}"></script>

</body>

</html>
