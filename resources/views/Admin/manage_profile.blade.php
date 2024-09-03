@extends('Admin.layouts.master')

@section('content')
@php
$currentPage = 'manage_profile';
@endphp


<!-- BEGIN LOADER -->


<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing ">
            <div class="top-tabel">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="card-title">Profile</h6>
                    </div>
                    <div class="col-md-8">

                    </div>
                </div>
            </div>
        </div>
        <div class="row widget-content widget-content-area br-8 position-btn m-auto py-3" style="overflow: auto;">
            <div class="row m-0 p-0 w-100">
                <div class="col-md-6 d-flex align-items-center justify-content-start mb-4" style="gap: 25px;">
                    <div>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a class="download-btn-custom mt-3 custom-width-15 m-0" href="{{route('logout')}}" style="height: fit-content;">
                        <span>Logout</span>
                    </a>
                </div>
            </div>
            <form method="post" action="" id="updateProfileForm" enctype="multipart/form-data">
                @csrf
                <div class="row m-0 p-0 w-75 mx-auto">

                    <div class="col-md-6 mb-3">
                        <label id="image-upload-button" for="profileImage">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                        </label>
                        <input class="d-none" type="file" id="profileImage" name="profile_photo" accept="image/*" onchange="previewImage(event)">

                        <div id="imagePreview" name="imagePreview" style="background-image: url('{{ $user->profile_photo ? asset('storage/app/public/uploads/admin_images/' . $user->profile_photo) : asset('storage/app/public/uploads/admin_images/user.png') }}')">
                        </div>

                    </div>
                    <div class="col-md-6 mb-3">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">First Name</label>
                        <input class="form-control" type="text" value="{{ $user->name }}" id="first_name" name="first_name" maxlength="15" required>
                    </div>
                    <div class="col-md-6">
                        <label for="">Phone Number</label>
                        <input class="form-control" type="tel" value="{{ $user->phone_number }}" id="phone_number" name="phone_number" maxlength="10" required>
                    </div>
                    <div class="col-md-6">
                        <label for="">Email Address</label>
                        <input class="form-control" type="email" value="{{ $user->email_address }}" id="email_address" name="email_address" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    </div>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="download-btn-custom mt-3 custom-width-10 mx-auto update_profile" id="updates_profile">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection


@section('section_script')

<script>
    // Select the start and end date inputs
    var startDateInput = document.getElementById("startDate");
    var endDateInput = document.getElementById("endDate");

    // Initialize Flatpickr for the date range with placeholders
    flatpickr(startDateInput, {
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr) {
            // Set the minimum date for the end date input
            endDatePicker.set("minDate", dateStr);
        }
    });

    var endDatePicker = flatpickr(endDateInput, {
        dateFormat: "Y-m-d",
    });


    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById('imagePreview');

        // Ensure that a file is selected
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Set the background image of the preview div
                preview.style.backgroundImage = 'url(' + e.target.result + ')';
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(input.files[0]);
        } else {
            // Clear the background image if no file is selected
            preview.style.backgroundImage = 'none';
        }
    }
</script>
<script>
    $(document).ready(function() {
        let base_url = url_path;
        // Initialize form validation

        $.validator.addMethod("lettersOnly", function(value, element) {
            return this.optional(element) || /^[a-zA-Z]+$/.test(value);
        }, "Please enter alphabetic characters only and spaces are not allowed");

        $('#updateProfileForm').validate({
            rules: {
                first_name: {
                    required: true,
                    lettersOnly: true
                },
                phone_number: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true 
                },
                email_address: {
                    required: true,
                    email: true
                },
                profileImage: {
                    required: true,
                    accept: 'image/*' // Ensure only image files are accepted
                }
            },
            messages: {
                first_name: {
                    required: 'Please enter your name',
                },
                phone_number: {
                    required: 'Please enter your phone number',
                    minlength: 'Phone number must be 10 digits long',
                    maxlength: 'Phone number must be 10 digits long',
                    digits: 'Please enter only digits'
                },
                email_address: {
                    required: 'Please enter your email address',
                    email: 'Please enter a valid email address'
                },
                profileImage: {
                    required: 'Please select a profile photo',
                    accept: 'Only image files are allowed'
                }
            },
            errorClass: 'error-message',
            submitHandler: function(form) {
                // Form is valid, proceed with form submission
                var formData = new FormData(form);

                $.ajax({
                    type: 'POST',
                    url: '{{ route('update.profile') }}',
                    data: formData,
                    beforeSend: function() {
                        $('#updates_profile').html('Please wait...');
                        $('#updates_profile').attr('disabled', true);
                    },
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 200) {
                            toastr.success("Profile Updated Successfully");
                            window.location.href = base_url + "/profile";
                        } else {
                            toastr.error("Error updating profile");
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            toastr.error(xhr.responseJSON.error);
                        } else {
                            toastr.error('Error updating profile');
                        }
                        console.log(xhr.responseText);
                    }
                });
                $('#updates_profile').attr('disabled', false);
                $('#updates_profile').text('Submit');
            }

        });
    });
</script>

@endsection