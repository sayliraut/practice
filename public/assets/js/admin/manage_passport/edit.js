$('#update_passport_btn').on("click", function (e) {

    $.validator.addMethod("lettersOnly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Please enter only alphabets");

    $.validator.addMethod("numbersOnly", function(value, element) {
        return this.optional(element) || /^[0-9]+$/.test(value);
    }, "Please enter only numbers");

    $('#update_passport').validate({
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
            // image: {
            //     required: true,
            // },
            expire_on:{
                required: true,
            },
            started:{
                required: true,
            },
            passport_price:{
                required: true,
                numbersOnly: true,
                maxlength: 10
            },
            'voucher_id[]':{
                required: true,
            },
            capacity:{
                required: true,
                digits: true
            },
            // restaurant:{
            //     required: true,
            // },
            // coupon_code:{
            //     required: true,
            //     maxlength: 10
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
            // image: {
            //     required: "Please Select Image",
            // },
            expire_on:{
                required: "Please Select Expire Date",
            },
            started:{
                required: "Please Select Start Date",
            },
            passport_price:{
                required: "Enter Passport Price ",
                maxlength: "Price cannot exceed 10 characters"
            },
            'voucher_id[]':{
                required: "Please Select Voucher",
            },
            capacity:{
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
        submitHandler: function(form) {
            let base_url = url_path;
            var formData = new FormData(form);

            // $('#update_passport_btn').text('Please wait...');
            // $('#update_passport_btn').attr('disabled', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: base_url + '/update_passport',
                type: 'POST',
                data: formData,
                beforeSend:function(){
                    $('#update_passport_btn').html('Please wait...');
                    $('#update_passport_btn').attr('disabled', true);
                },
                processData: false,
                contentType: false,
                success: function(result) {

                    if (result.status_code == 200) {
                        toastr.success('Passport Updated Sucessfully');
                        setTimeout(function() {
                            window.location.href = base_url + "/manage_passport";
                        }, 2000);
                    } else {
                        toastr.error('Something Went Wrong');
                        setTimeout(function() {
                            window.location.href = base_url + "/manage_passport";
                        }, 2000);
                    }
                    $('#update_passport_btn').attr('disabled', false);
                    $('#update_passport_btn').text('Submit');
                },

            });

            $('#store_coupon').attr('disabled', false);
                    $('#store_coupon').text('Submit');
        }
    });
});
