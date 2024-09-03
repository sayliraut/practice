$(document).ready(function () {
    $('#editNotificationForm').validate({
        ignore: [],
        debug: false,
        rules: {
            type: {
                required: true
            },
            description: {
                required: true
            },
            delivery_schedule: {
                required: true,
            }
        },
        messages: {
            type: {
                required: 'Please enter the notification title'
            },
            description: {
                required: 'Please enter the description'
            },
            delivery_schedule: {
                required: 'Please select a delivery schedule',
            }
        },
        errorClass: 'error-message',
        submitHandler: function (form) {
            var formData = new FormData(form);

            $('#update_notification').text('Please wait...');
            $('#update_notification').attr('disabled', true);
            let base_url = url_path;


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                url: base_url + '/manage_update_notifications',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (result) {
                    if (result.status_code == 200) {
                        toastr.success('Notification Updated Successfully');
                        setTimeout(function () {
                            window.location.href =
                                base_url + '/manage-notification';


                        }, 2000);
                    } else {
                        toastr.error('Something Went Wrong');
                        setTimeout(function () {
                            window.location.href =
                            base_url + '/manage-notification';
                        }, 2000);
                    }
                    $('#update_notification').attr('disabled', false);
                    $('#update_notification').text('Submit');
                },
                error: function (xhr) {
                    toastr.error('An error occurred: ' + xhr.responseText);
                    $('#update_notification').attr('disabled', false);
                    $('#update_notification').text('Submit');
                }
            });
        }
    });
});


$(document).ready(function () {
    $('input[name="user_type"]').change(function () {
        var selectedValue = $(this).val();

        $('.dropdown-container').hide();

        // Disable all checkboxes
        $('.dropdown-container input[type="checkbox"]').prop('disabled', true);

        // Enable and show the checkboxes for the selected radio button
        $('#dropdown-' + selectedValue + '-edit').show();
        $('#dropdown-' + selectedValue + '-edit input[type="checkbox"]').prop('disabled', false);
    });

    // Trigger the change event on page load to set the initial state
    $('input[name="user_type"]:checked').trigger('change');

    // Select All functionality
    $('.select-all-checkbox').change(function () {
        var groupNumber = $(this).data('group');
        var isChecked = $(this).is(':checked');
        $('.state-group-' + groupNumber + '-checkbox').prop('checked', isChecked);
    });

    // Check if all checkboxes are checked when loading the form
    $('.select-all-checkbox').each(function () {
        var groupNumber = $(this).data('group');
        var allChecked = $('.state-group-' + groupNumber + '-checkbox').length === $(
            '.state-group-' + groupNumber + '-checkbox:checked').length;
        $(this).prop('checked', allChecked);
    });

    // Update "Select All" checkbox when any state checkbox is changed
    $('.state-checkbox').change(function () {
        var groupNumber = $(this).closest('.dropdown-container').find('.select-all-checkbox').data(
            'group');
        var allChecked = $('.state-group-' + groupNumber + '-checkbox').length === $(
            '.state-group-' + groupNumber + '-checkbox:checked').length;
        $('#select-all-' + groupNumber + '-edit').prop('checked', allChecked);
    });
});


const imageInputEdit = document.getElementById('imageInputNormal');
const imagePreviewEdit = document.getElementById('imageInputPreviewNormal');

imageInputEdit.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            const img = document.createElement('img');
            img.src = event.target.result;
            img.style.maxWidth = '60px';
            img.style.maxHeight = '60px';
            imagePreviewEdit.innerHTML = '';
            imagePreviewEdit.appendChild(img);
        };
        reader.readAsDataURL(file);
    } else {
        imagePreviewEdit.innerHTML = '';
    }
});
