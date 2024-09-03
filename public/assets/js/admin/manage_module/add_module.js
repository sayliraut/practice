$(document).ready(function() {

    $.validator.addMethod("lettersOnly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Please enter only alphabets");

    $('#store_module').validate({
        rules: {
            module_name: {
                required: true,
                lettersOnly: true
            }
        },
        messages: {
            module_name: {
                required: "Please enter the Module.",
            }
        },
        errorClass: 'error-message',
        submitHandler: function (form, e) { // Add 'e' parameter to the submitHandler function
            e.preventDefault();
            let base_url = url_path;
            var formData = new FormData(form);
            
            $('#submit_module').text('Please wait...');
            $('#submit_module').attr('disabled', true);

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                url: base_url + '/insert_module',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == 200) {
                        toastr.success('Module added successfully');
                        setTimeout(function () {
                            window.location.href = base_url + "/manage_module";
                        }, 1000);
                    } else if (response.status == 400) {
                        toastr.error(response.message);
                        form.reset();
                        $('#submit_module').prop('disabled', false);
                        $('#submit_module').text('Submit');
                    } else {
                        toastr.error("Something went wrong");
                    }
                    $('#submit_module').attr('disabled', false);
                    $('#submit_module').text('Submit');
                },
            });
        }
    });
});
