$(document).ready(function() {
    $(document).on("click", ".edit_module_value", function (e) {
        var edit_id = $(this).data('module-id');
        var edit_module = $(this).data('module-name');
        var edit_slug = $(this).data('module-slug');
        $('#module_id').val(edit_id);
        $('#name').val(edit_module);
        $('#slug').val(edit_slug);

    });

    $.validator.addMethod("lettersOnly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Please enter only alphabets");

    $('#edit_module').validate({
        rules: {
            module_name: {
                required: true,
                lettersOnly: true
            },
            module_slug: {
                required: true,
            }
        },
        messages: {
            module_name: {
                required: "Please enter the Module.",
            },
            module_slug: {
                required: "Please enter the Slug.",
            }
        },
        errorClass: 'error-message',
        submitHandler: function (form,e) {
            e.preventDefault();
            let base_url = url_path;
            var formData = new FormData(form);

                $('#update_module').text('Please wait...');
                $('#update_module').attr('disabled', true);
            
            $.ajax({
                url: base_url + '/update_module',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {

                    if (result.status_code == 200) {
                        toastr.success('Module Updated successfully');
                        setTimeout(function() {
                            window.location.href = base_url + "/manage_module";
                        }, 2000);
                    } else {
                        toastr.error('Something Went Wrong');
                        setTimeout(function() {
                            window.location.href = base_url + "/manage_module";
                        }, 2000);
                    }
                    $('#update_module').attr('disabled', false);
                    $('#update_module').text('Submit');
                },
            });
            $('#update_module').attr('disabled', false);
            $('#update_module').text('Submit');
        }
    });
});