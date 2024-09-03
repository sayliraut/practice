// privacy policy for cust
$('#update_privacy_policy').on("click", function (e) {
    
$.validator.addMethod("quillNotEmpty", function(value, element) {
    var quill = new Quill('#terms-quill-edit');
    return quill.getText().trim().length > 0;
}, "Please enter privacy Policy ");

    $('#privacy_policy_form').validate({
        ignore: [],
        debug: false,
        rules: {
            privacy_policy: {
                required: true,
                quillNotEmpty: true
            }
        },
        messages: {
            privacy_policy: {
                required: "Please Enter Privacy Policy"
            }
        },
        errorClass: 'error-message',
        submitHandler: function (form) {
            let base_url = url_path;
            var formData = new FormData(form);
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
                $.ajax({
                    url: base_url + '/privacy_policy_update',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status == 200) {
                            toastr.success('Privacy Policy Data Updated Successfully');
                            setTimeout(function () {
                                window.location.href = base_url + "/privacy";
                            }, 1000);
                        } else {
                            toastr.error("Something went wrong");
                        }
                    },
                });
        }
    });
});





// privacy policy for rest
$('#update_privacy_policy_rest').on("click", function (e) {
    // alert("kjhskhf");
$.validator.addMethod("quillNotEmpty", function(value, element) {
    var quill = new Quill('#terms-quill-edit');
    return quill.getText().trim().length > 0;
}, "Please enter privacy Policy");

    $('#privacy_policy_form_rest').validate({
        ignore: [],
        debug: false,
        rules: {
            edit_privacy_policy_rest: {
                required: true,
                quillNotEmpty: true
            }
        },
        messages: {
            edit_privacy_policy_rest: {
                required: "Please Enter Privacy Policy"
            }
        },
        errorClass: 'error-message',
        submitHandler: function (form) {
            let base_url = url_path;
            var formData = new FormData(form);
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
                $.ajax({
                    url: base_url + '/privacy_policy_update_rest',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status == 200) {
                            toastr.success('Privacy Policy Data Updated Successfully');
                            setTimeout(function () {
                                window.location.href = base_url + "/privacy";
                            }, 1000);
                        } else {
                            toastr.error("Something went wrong");
                        }
                    },
                });
        }
    });
});