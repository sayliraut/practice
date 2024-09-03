$(document).ready(function() {
    // Custom validator for checking state checkboxes
    $.validator.addMethod('stateRequired', function(value, element) {
        let selectedUserType = $('input[name="user_type"]:checked').val();
        if (selectedUserType) {
            let dropdownId = `dropdown-${selectedUserType}`;
            return $(`#${dropdownId} .state-checkbox:checked`).length > 0;
        }
        return true;
    }, 'Please select at least one state.');

    // Validate the form
    $('#send_notification_form').validate({
        ignore: [],
        debug: false,
        rules: {
            title: {
                required: true
            },
            description: {
                required: true
            },
            image: {
                required: true
            },
            user_type: {
                required: true
            },
            schedule_radio1: {
                required: true
            },
            schedule_date: {
                required: function() {
                    return $('#push_schedule_radi02').is(':checked');
                }
            },
            'states[]': {
                stateRequired: true
            }
        },
        messages: {
            title: {
                required: 'Please enter this field'
            },
            description: {
                required: 'Please enter this field'
            },
            image: {
                required: 'Please upload an image file'
            },
            user_type: {
                required: 'Please select at least one category'
            },
            schedule_radio1: {
                required: 'Please select a delivery schedule'
            },
            schedule_date: {
                required: 'Please select a specific time'
            },
            'states[]': {
                stateRequired: 'Please select at least one state.'
            }
        },
        errorClass: 'error-message',
        errorPlacement: function(error, element) {
            if (element.attr("name") == "user_type") {
                error.appendTo("#user_type_error").addClass('error-message');
            } else if (element.attr("name") == "schedule_radio1") {
                error.insertAfter("#push_schedule_radi02").addClass('error-message');
            } else if (element.attr("name") == "states[]") {
                error.insertAfter(`#dropdown-${$('input[name="user_type"]:checked').val()}`)
                error.appendTo("#user_type_error").addClass('error-message');
            } else {
                error.insertAfter(element).addClass('error-message');
            }
        },
        submitHandler: function(form) {
            var formData = new FormData(form);
            let base_url = url_path;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: base_url + '/insert_notification',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('#store_notification_btn').html('Please wait...');
                    $('#store_notification_btn').attr('disabled', true);
                },
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.status_code == 200) {
                        toastr.success(result.message);
                        setTimeout(function() {
                            window.location.href = base_url +
                                "/manage-notification";
                        }, 2000);
                    } else if (result.status_code == 422) {
                        // Display validation errors using toastr
                        $.each(result.errors, function(key, value) {
                            toastr.error(value);
                            setTimeout(function() {
                                window.location.href = base_url +
                                    "/manage-notification";
                            }, 2000);
                        });
                    } else {
                        toastr.error('Something Went Wrong');
                        setTimeout(function() {
                            window.location.href = base_url +
                                "/manage-notification";
                        }, 2000);
                    }
                    $('#store_notification_btn').attr('disabled', false);
                    $('#store_notification_btn').text('Submit');
                },
            });
        }
    });

    // Hide date and time input by default
    $('.checkbox-btsss').hide();

    // Show/hide date and time input based on radio button selection
    $('#push_schedule_radi01').click(function() {
        $('.checkbox-btsss').hide();
        $('input[name="schedule_date"]').val(''); // Clear date and time input
    });

    $('#push_schedule_radi02').click(function() {
        $('.checkbox-btsss').show();
    });

});



document.addEventListener('DOMContentLoaded', function() {
    function handleUserTypeChange() {
        var dropdowns = [
            document.getElementById('dropdown-1'),
            document.getElementById('dropdown-2'),
            document.getElementById('dropdown-3')
        ];

        dropdowns.forEach(function(dropdown, index) {
            if (index + 1 == this.value) {
                dropdown.style.display = 'block';
                toggleCheckboxes(dropdown, false);
            } else {
                dropdown.style.display = 'none';
                toggleCheckboxes(dropdown, true);
            }
        }, this);
    }

    function toggleCheckboxes(dropdown, disable) {
        var checkboxes = dropdown.querySelectorAll('.form-check-input');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].disabled = disable;
        }
    }

    var userTypeRadios = document.getElementsByName('user_type');
    for (var i = 0; i < userTypeRadios.length; i++) {
        userTypeRadios[i].addEventListener('change', handleUserTypeChange);
    }

    var checkedRadio = document.querySelector('input[name="user_type"]:checked');
    if (checkedRadio) {
        handleUserTypeChange.call(checkedRadio);
    }

    function handleSelectAllChange() {
        var dropdown = this.closest('div[id^="dropdown-"]');
        var checkboxes = dropdown.querySelectorAll('.state-checkbox');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    }

    var selectAllCheckboxes = document.querySelectorAll('.select-all-checkbox');
    for (var i = 0; i < selectAllCheckboxes.length; i++) {
        selectAllCheckboxes[i].addEventListener('change', handleSelectAllChange);
    }
});


function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();

    reader.onload = function() {
        var preview = document.getElementById('preview');
        preview.src = reader.result;
        preview.style.display = 'block';
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}
