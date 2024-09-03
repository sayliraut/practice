$(document).ready(function () {

    $.validator.addMethod("lettersOnly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Please enter only alphabets");

    $.validator.addMethod("numbersOnly", function (value, element) {
        return this.optional(element) || /^[0-9]+$/.test(value);
    }, "Please enter only numbers");

    // $.validator.addMethod("voucherSelection", function(value, element) {
    //     return $(element).val().length === 7;
    // }, "Please select exactly 7 vouchers");

    $('#store_passport').validate({
        ignore: [],
        debug: false,
        rules: {
            name: {
                required: true,
                lettersOnly: true
            },
            passport_desciption: {
                required: true,
            },
            id: {
                required: true,
            },
            activated: {
                required: true,
            },
            image: {
                required: true,
            },
            thumbnail_image: {
                required: true,
            },
            expire_on: {
                required: true,
            },
            started: {
                required: true,
            },
            price: {
                required: true,
                numbersOnly: true,
                maxlength: 10
            },
            city: {
                required: true,
            },
            'voucher_id[]': {
                required: true,
                maxlength: 7
            },
            capacity: {
                required: true,
                digits: true
            },
            // restaurant:{
            //     required: true,
            // },
            // coupon_code:{
            //     required: true,
            //     maxlength: 20
            // }
        },
        messages: {
            name: {
                required: "Enter Passport Name",
            },
            passport_desciption: {
                required: "Enter Passport Description",
            },
            id: {
                required: "Enter Passport Id",
            },
            activated: {
                required: "Please Select Activated Date",
            },
            image: {
                required: "Please Select Image",
            },
            thumbnail_image: {
                required: "Please Select Image",
            },
            expire_on: {
                required: "Please Select Expire Date",
            },
            started: {
                required: "Please Select Start Date",
            },
            price: {
                required: "Enter Passport Price ",
                maxlength: "Price cannot exceed 20 characters"
            },
            city: {
                required: "Please Select City",
            },
            'voucher_id[]': {
                required: "Please Select Voucher",
                maxlength: "You can select a maximum of 7 vouchers",
            },
            capacity: {
                required: "Please enter capacity",
                digits: "Please enter a numeric value for capacity"
            },
            // restaurant:{
            //     required: "Please Select Restaurant",
            // },
            // coupon_code:{
            //     required: "Please Enter coupon code",
            //     maxlength: "Coupon Code cannot exceed 10 characters"
            // }
        },
        errorClass: 'error-message',
        submitHandler: function (form) {
            var formData = new FormData(form);
            let base_url = url_path;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: base_url + '/insert_passport',
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('#store_passport_btn').html('Please wait...');
                    $('#store_passport_btn').attr('disabled', true);
                },
                processData: false,
                contentType: false,
                success: function (result) {

                    console.log("result", result);
                    if (result.status_code == 200) {
                        toastr.success('passport added successfully');
                        setTimeout(function () {
                            window.location.href = base_url + "/manage_passport";
                        }, 2000);
                    } else {
                        toastr.error('Something Went Wrong');
                        setTimeout(function () {
                            window.location.href = base_url + "/manage_passport";
                        }, 2000);
                    }
                    $('#store_passport_btn').attr('disabled', false);
                    $('#store_passport_btn').text('Submit');
                },

            });

            $('#store_passport_btn').attr('disabled', false);
            $('#store_passport_btn').text('Submit');
        }
    });
});
