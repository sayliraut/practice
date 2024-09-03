$(document).ready(function() {
    $(document).on("click", ".edit_location_value", function (e) {
        e.preventDefault(); // Prevent default action

        var locationId = $(this).data('location-id');
        var locationName = $(this).data('location-name');
        var timeHours = $(this).data('location-timehours');
        var timeInterval = $(this).data('location-timeinterval');
        var quantity = $(this).data('location-quantity');

        console.log('Location ID:', locationId);
        console.log('Location Name:', locationName);
        console.log('Time Hours:', timeHours);
        console.log('Time Interval:', timeInterval);
        console.log('Quantity:', quantity);

        $('#location_id').val(locationId);
        $('#location-name').val(locationName);
        $('#time-hours').val(timeHours);
        $('#time-interval').val(timeInterval);
        $('#quantity').val(quantity);

        $('#edit-location-modal').modal('show');
    });
});


$(document).ready(function() {
    // Assuming you have a mechanism to set manage_state_xid in the modal
    $('#edit-location-modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var locationId = button.data('location-id'); // Extract info from data-* attributes
        var manageStateXid = button.data('manage-state-xid');

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content.
        var modal = $(this);
        modal.find('#location_id').val(locationId);
        modal.find('#manage_state_xid').val(manageStateXid);
    });

    $('#edit_location').validate({
        rules: {
            location_name: { required: true },
            time_hours: { required: true, digits: true },
            quantity: { required: true, digits: true },
            time_interval: { required: true }
        },
        messages: {
            location_name: { required: "Please enter the location name." },
            time_hours: { required: "Please enter time hours.", digits: "Please enter a valid number for time hours." },
            quantity: { required: "Please enter quantity.", digits: "Please enter a valid number for quantity." },
            time_interval: { required: "Please select a time interval." }
        },
        errorClass: 'error-message',
        submitHandler: function(form) {
            var formData = new FormData(form);
            let base_url = url_path;
            $('#update_location').text('Please wait...');
            $('#update_location').attr('disabled', true);
            $.ajax({
                url: base_url + '/update_location',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.success) {
                        toastr.success('Location updated successfully');
                        setTimeout(function() {
                            window.location.href = base_url + "/manage_location";
                        }, 2000);
                    } else {
                        toastr.error(result.error || 'Something went wrong');
                    }
                    $('#update_location').attr('disabled', false);
                    $('#update_location').text('Save');
                },
                error: function(xhr, status, error) {
                    toastr.error('Something went wrong');
                    $('#update_location').attr('disabled', false);
                    $('#update_location').text('Save');
                }
            });
        }
    });
});
