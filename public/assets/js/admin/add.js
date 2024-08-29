$(document).ready(function() {
    $('#stateSelect').on('change', function() {
        let stateId = $(this).val();
        let citySelect = $('#citySelect');

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

$(document).ready(function() {
    $(document).on('click', '.add-education', function() {
        let newEntry = `
                <div class="row education-entry mt-2">
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="education_title[]" placeholder="Education" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="year_of_completion[]" placeholder="Year Of Completion" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-education">Remove</button>
                    </div>
                </div>`;
        $('#education-container').append(newEntry);
    });

    $(document).on('click', '.remove-education', function() {
        $(this).closest('.education-entry').remove();
    });
});


$(document).ready(function() {
    $('.select2').select2();

    $('input[name="profession"]').on('change', function() {
        if (this.value === 'salaried') {
            $('#salaried-fields').show();
            $('#self-employed-fields').hide();
        } else if (this.value === 'self-employed') {
            $('#salaried-fields').hide();
            $('#self-employed-fields').show();
        }
    });

    $('#salaried-fields').hide();
    $('#self-employed-fields').hide();
});


selectImage.onchange = evt => {
    preview = document.getElementById('preview');
    preview.style.display = 'block';
    const [file] = selectImage.files
    if (file) {
        preview.src = URL.createObjectURL(file)
    }
}


$(document).ready(function() {
    $('#update_restaurant_form').validate({
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
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            var formData = new FormData(form);

            var base_url = url_path;

            $('#update_user_btn').text('Please wait...');
            $('#update_user_btn').attr('disabled', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: base_url + '/store_user',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.status_code == 200) {
                        toastr.success('User Created Successfully');
                        setTimeout(function() {
                            window.location.href = base_url + "/dashboard";
                        }, 2000);
                    } else {
                        toastr.error('Something Went Wrong');
                        setTimeout(function() {
                            window.location.href = base_url + "/dashboard";
                        }, 2000);
                    }
                    $('#update_user_btn').attr('disabled', false);
                    $('#update_user_btn').text('Submit');
                },
                error: function(xhr, status, error) {
                    toastr.error('Something Went Wrong: ' + error);
                    $('#update_user_btn').attr('disabled', false);
                    $('#update_user_btn').text('Submit');
                }
            });
        }
    });
});
