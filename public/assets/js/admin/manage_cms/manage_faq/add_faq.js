// add faq start here
$(document).on("click", "#submit_faq", function (e) {

    $('#store_faq').validate({
        rules: {
            question: {
                required: true,
                maxlength: 255
            },
            answer: {
                required: true,
            },
            faq_categ: {
                required: true
            },
        },
        messages: {
            question: {
                required: "Please enter the question.",
                maxlength: "The question must be at least 255 characters long."
            },
            answer: {
                required: "Please enter the answer.",
            },
            faq_categ: {
                required: "Please select category."
            },
        },
        errorClass: 'error-message',
        submitHandler: function (form) {
            let base_url = url_path;
            var formData = new FormData(form);
            e.preventDefault(); // Prevent default form submission behavior

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                url: base_url + '/store_faq',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == 200) {
                        toastr.success('Faq added successfully');
                        setTimeout(function () {
                            window.location.href = base_url + "/faq";
                        }, 1000);
                    } else {
                        toastr.error("Something went wrong");
                    }
                },
            });
        }
    });
});



