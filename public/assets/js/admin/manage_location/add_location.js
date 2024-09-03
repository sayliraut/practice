$(document).on("click", "#submit_location", function (e) {
    $('#store_location').validate({
        rules: {
            location_name: {
                required: true,
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
            }
        },
        messages: {
            location_name: {
                required: "Please enter the state.",
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
            }
        },


        errorClass: 'error-message',
        submitHandler: function (form) {
            e.preventDefault();
            let base_url = url_path;
            var formData = new FormData(form);
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                url: base_url + '/insert_location',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == 200) {
                        toastr.success('Location added successfully');
                        setTimeout(function () {
                            window.location.href = base_url + "/manage_location";
                        }, 1000);
                    } else if (response.status == 422 && response.error === 'Location name already exists') {
                        toastr.error('Location name already exists');
                    } else {
                        toastr.error("Something went wrong");
                    }
                },
                error: function (xhr, status, error) {
                    // Handle the case where the server returns an error
                    if (xhr.status == 422 && xhr.responseJSON.error === 'Location name already exists') {
                        toastr.error('Location name already exists');
                    } else {
                        toastr.error("An error occurred");
                    }
                }
            });
        }
    });
});
