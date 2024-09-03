$(document).ready(function() {
    var quill = new Quill('#terms-quill-edit', {
        theme: 'snow'
    });

    var storedMessage = document.getElementById('stored-terms-message').value;
    quill.clipboard.dangerouslyPasteHTML(storedMessage);

    $('#update_terms').on("click", function(e) {
        e.preventDefault();  
        $('#terms_form').validate({
            ignore: [],
            debug: false,
            rules: {
                article_des: {
                    required: true,
                    minlength:1000,
                }
            },
            messages: {
                article_des: {
                    required: "Please Enter Terms and Condition",
                    minlength:"Please Enter Terms and Condition"
                }
            },
            errorClass: 'error-message',

            submitHandler: function(form) {
                // Get the HTML content from Quill editor
                var article_des = quill.root.innerHTML;
                
                if (article_des.trim() === '<p><br></p>') {
                    toastr.error("Please Enter Terms and Condition");
                    return false;
                }

                let base_url = url_path;
                var custom_id = document.querySelector('input[name="custom_id"]').value;

                // Create a form data object
                var formData = new FormData(form);
                formData.append('article_des', article_des);

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    url: base_url + '/update_terms',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            toastr.success('Terms and Condition Data Updated Successfully');
                            setTimeout(function() {
                                window.location.href = base_url + "/terms";
                            }, 1000);
                        } else {
                            toastr.error("Something went wrong");
                        }
                    },
                    error: function(response) {
                        toastr.error("An error occurred while updating the terms");
                    }
                });
            }
        });

        // Trigger form validation
        $('#terms_form').submit();
    });
});


$(document).ready(function() {
    var quill = new Quill('#termsRest-quill-edit', {
        theme: 'snow'
    });

    var storedMessage = document.getElementById('stored-terms-rest-message').value;
    quill.clipboard.dangerouslyPasteHTML(storedMessage);

    $('#update_termsrest').on("click", function(e) {
        e.preventDefault();  
        $('#terms_rest_form').validate({
            ignore: [],
            debug: false,
            rules: {
                termsrest_des: {
                    required: true,
                    minlength:1000,
                }
            },
            messages: {
                termsrest_des: {
                    required: "Please Enter Terms and Condition",
                    minlength:"Please Enter Terms and Condition"
                }
            },
            errorClass: 'error-message',

            submitHandler: function(form) {
                // Get the HTML content from Quill editor
                var termsrest_des = quill.root.innerHTML;
                
                if (termsrest_des.trim() === '<p><br></p>') {
                    toastr.error("Please Enter Terms and Condition");
                    return false;
                }

                let base_url = url_path;
                var termRest_id = document.querySelector('input[name="termRest_id"]').value;

                // Create a form data object
                var formData = new FormData(form);
                formData.append('termsrest_des', termsrest_des);

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    url: base_url + '/update_terms_rest',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            toastr.success('Terms and Condition Data Updated Successfully');
                            setTimeout(function() {
                                window.location.href = base_url + "/terms";
                            }, 1000);
                        } else {
                            toastr.error("Something went wrong");
                        }
                    },
                    error: function(response) {
                        toastr.error("An error occurred while updating the terms");
                    }
                });
            }
        });

        // Trigger form validation
        $('#terms_rest_form').submit();
    });
});




