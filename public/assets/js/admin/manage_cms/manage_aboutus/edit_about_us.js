CKEDITOR.replace('terms-quill-edit', {
    toolbar: [
        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
        { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
        { name: 'styles', items: ['Format'] },
        { name: 'links', items: ['Link', 'Unlink'] },
        { name: 'tools', items: ['Maximize'] }
    ]
});

// Listen for changes and update the hidden input with the HTML content
CKEDITOR.instances['terms-quill-edit'].on('change', function() {
    var htmlContent = CKEDITOR.instances['terms-quill-edit'].getData();
    document.getElementById('about_rest').value = htmlContent;
});

$('#update_aboutUS_rest').on("click", function(e) {

    $.validator.addMethod("quillNotEmpty", function(value, element) {
        var editorData = CKEDITOR.instances['terms-quill-edit'].getData();
        return editorData.trim().length > 0;
    }, "Please enter about us");

    $('#aboutus_rest_form').validate({
        ignore: [],
        debug: false,
        rules: {
            about_rest: {
                required: true,
                quillNotEmpty: true
            }
        },
        messages: {
            about_rest: {
                required: "Please Enter about us for restaturant"
            }
        },
        errorClass: 'error-message',
        submitHandler: function(form) {
            var editorData = CKEDITOR.instances['terms-quill-edit'].getData();
            $('#about_rest').val(editorData);
            let base_url = url_path;


            var formData = new FormData(form);
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                url: base_url + '/aboutus_rest_update',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == 200) {
                        toastr.success('About Us Restaturant Data Updated Successfully');
                        setTimeout(function() {
                            window.location.href = base_url + '/manage-about-us';
                        }, 1000);
                    } else {
                        toastr.error("Something went wrong");
                    }
                },
            });
        }
    });
});
