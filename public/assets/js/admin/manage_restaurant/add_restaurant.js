$(document).ready(function () {
    $('#update_restaurant_form').validate({
        ignore: [],
        debug: false,
        rules: {
            name: {
                required: true
            },
            state_xid: {
                required: true
            },
            rest_id: {
                required: true
            },
            address: {
                required: true
            },
            image: {
                required: true
            },
            phone_number: {
                required: true
            },
            latitude: {
                required: true,
                number: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            longitude: {
                required: true,
                number: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            bio: {
                required: true
            },
            try_on_1: {
                required: true,
                maxlength: 18,
            },
            try_on_2: {
                required: true,
                maxlength: 18,

            },
            try_on_3: {
                required: true,
                maxlength: 18,

            },
            try_on_4: {
                required: true,
                maxlength: 18,

            },
            timeHours: {
                required: true,
                number: true,
                min: 1
            },
            timeQuantity: {
                required: true,
                number: true,
                min: 1
            },
            maxCocktails: {
                required: true,
                number: true,
                min: 1
            },
            'start_time[]': {
                required: function (element) {
                    return $(element).closest('.closed-hour-entry').find(
                        'select[name="day_of_week[]"]').val() !== '';
                }
            },
            'end_time[]': {
                required: function (element) {
                    return $(element).closest('.closed-hour-entry').find(
                        'select[name="day_of_week[]"]').val() !== '';
                }
            }
        },
        messages: {
            name: {
                required: "Enter restaurant Name"
            },
            state_xid: {
                required: "Please Select state"
            },
            rest_id: {
                required: "Enter restaurant Id"
            },
            address: {
                required: "Please enter location"
            },
            image: {
                required: "Please insert image"
            },
            phone_number: {
                required: "Please enter phone number"
            },
            latitude: {
                required: "Please enter latitude",
                number: "Latitude must be a number without spaces"
            },
            longitude: {
                required: "Please enter longitude",
                number: "Longitude must be a number without spaces"
            },
            bio: {
                required: "Enter Bio"
            },
            try_on_1: {
                required: "Please enter this field",
                maxlength: "Maximum length is 18 characters"

            },
            try_on_2: {
                required: "Please enter this field",
                maxlength: "Maximum length is 18 characters"

            },
            try_on_3: {
                required: "Please enter this field",
                maxlength: "Maximum length is 18 characters"

            },
            try_on_4: {
                required: "Please enter this field",
                maxlength: "Maximum length is 18 characters"

            },
            timeHours: {
                required: "Please enter the time in hours between redeeming two cocktails",
                number: "Time must be a number",
                min: "Time must be greater than 0"
            },
            timeQuantity: {
                required: "Please enter the time quantity",
                number: "Time quantity must be a number",
                min: "Time quantity must be greater than 0"
            },
            maxCocktails: {
                required: "Please enter the maximum number of cocktails",
                number: "Maximum number of cocktails must be a number",
                min: "Maximum number of cocktails must be greater than 0"
            },
            'start_time[]': {
                required: "Please select a start time"
            },
            'end_time[]': {
                required: "Please select an end time"
            }
        },
        errorClass: 'error-message',
        submitHandler: function (form) {

            var form = $('#update_restaurant_form')[0];
            var formData = new FormData(form);
            let base_url = url_path;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: base_url + '/store_restaurant',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#update_restaurant_btn').html('Please wait...');
                    $('#update_restaurant_btn').attr('disabled', true);
                },
                success: function (result) {
                    if (result.status_code == 200) {
                        toastr.success('Restaurant Updated Successfully');
                        setTimeout(function () {
                            window.location.href = base_url +
                                "/manage-restaurants";
                        }, 2000);
                    } else {
                        toastr.error('Something Went Wrong');
                        setTimeout(function () {
                            window.location.href = base_url +
                                "/manage-restaurants";
                        }, 2000);
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error('Something Went Wrong');
                },
                complete: function () {
                    $('#update_restaurant_btn').attr('disabled', false);
                    $('#update_restaurant_btn').text('Submit');
                }
            });
        }
    });

    $(document).on("click", "#update_restaurant_btn", function (e) {
        e.preventDefault();
        $('#update_restaurant_form').submit();
    });
});
