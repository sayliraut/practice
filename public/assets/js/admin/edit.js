$(document).ready(function() {
    $('.select2').select2();

    $('input[name="profession"]').change(function() {
        if ($(this).val() == 'Salaried') {
            $('#salaried-fields').show();
            $('#self-employed-fields').hide();
        } else if ($(this).val() == 'Self-employed') {
            $('#salaried-fields').hide();
            $('#self-employed-fields').show();
        }
    });

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
                                "/dashboard";
                        }, 2000);
                    } else {
                        toastr.error(result.message);
                        setTimeout(function() {
                            window.location.href = base_url +
                                "/dashboard";
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

