$(document).on("click", "#add_about_btn", function (e) {

    $.validator.addMethod("quillNotEmpty", function(value, element) {
        var quill = new Quill('#about-quill-add');
        return quill.getText().trim().length > 0;
    }, "Please enter description ");

    $('#add_about_form').validate({
        ignore: [],
        debug: false,
        rules: {
            about_title: {
                required: true
            },
            about_des: {
                required: true,
                quillNotEmpty: true
            },
            about_image: {
                required: true
            },
            category: {
                required: true
            },
        },
        messages: {
            about_title: {
                required: "Please Enter Title"
            },
            about_des: {
                required: "Please Enter Description"
            },
            about_image: {
                required: "Please Select Image"
            },
            category: {
                required: "Please Select Category"
            },
        },
        errorClass: 'error-message',
        submitHandler: function(form) {
            var formData = new FormData(form);
            let base_url = url_path;

            $('#add_about_btn').text('Please wait...');
            $('#add_about_btn').attr('disabled', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: base_url + '/insert_about_us',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {

                    console.log("result",result);
                    if (result.status_code == 200) {
                        toastr.success('About Us Data Added Successfully');
                        setTimeout(function() {
                            window.location.href = base_url + "/manage-about-us";
                        }, 2000);
                    } else {
                        toastr.error('Something Went Wrong');
                        setTimeout(function() {
                            window.location.href = base_url + "/manage-about-us";
                        }, 2000);
                    }
                    $('#add_about_btn').attr('disabled', false);
                    $('#add_about_btn').text('Submit');
                },
               
            });

            $('#add_about_btn').attr('disabled', false);
                    $('#add_about_btn').text('Submit');
        }
    });
});

selectImage.onchange = evt => {
    preview = document.getElementById('preview');
    preview.style.display = 'block';
    const [file] = selectImage.files
    if (file) {
        preview.src = URL.createObjectURL(file)
    }
}