$(document).ready(function() {
    // Initialize Quill editors
    var quillTitle = new Quill('#rules-quill-edit-title', {
        theme: 'snow'
    });

    var quillMessage = new Quill('#rules-quill-edit-message', {
        theme: 'snow'
    });

    // Set initial content for Quill editors
    var storedTitle = $('textarea[name="whats_inside"]').val();
    quillTitle.clipboard.dangerouslyPasteHTML(storedTitle);

    var storedMessage = $('textarea[name="rules"]').val();
    quillMessage.clipboard.dangerouslyPasteHTML(storedMessage);

    // Form submission logic
    $('#update_rules').on("click", function(e) {
        e.preventDefault();

        $.validator.addMethod("quillNotEmpty", function(value, element) {
            var editorData = quillTitle.root.innerHTML;
            return editorData.trim().length > 0;
        }, "Please enter What's Inside");

        $.validator.addMethod("quillNotEmptyMessage", function(value, element) {
            var editorData = quillMessage.root.innerHTML;
            return editorData.trim().length > 0;
        }, "Please enter Rules");

        $('#rules_form').validate({
            ignore: [],
            debug: false,
            rules: {
                whats_inside: {
                    required: true,
                    quillNotEmpty: true
                },
                rules: {
                    required: true,
                    quillNotEmptyMessage: true
                }
            },
            messages: {
                whats_inside: {
                    required: "Please enter What's Inside"
                },
                rules: {
                    required: "Please enter Rules"
                }
            },
            errorClass: 'error-message',
            submitHandler: function(form) {
                function base64Encode(str) {
                    return btoa(unescape(encodeURIComponent(str)));
                }

                var article_des_title = base64Encode(quillTitle.root.innerHTML);
                var article_des_message = base64Encode(quillMessage.root.innerHTML);

                // Update the hidden textareas with encoded content
                $('textarea[name="whats_inside"]').val(article_des_title);
                $('textarea[name="rules"]').val(article_des_message);
                let base_url = url_path;


                var formData = new FormData(form);
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"),
                    },
                });

                $.ajax({
                    url: base_url + '/update_rules',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            toastr.success(
                                'Rules Data Updated Successfully');
                            setTimeout(function() {
                                window.location.href =
                                base_url + '/manage_rules';
                            }, 1000);
                        } else {
                            toastr.error("Something went wrong");
                        }
                    },
                    error: function(response) {
                        toastr.error(
                            "An error occurred while updating the rules"
                            );
                    }
                });
            }
        });

        // Trigger form validation
        $('#rules_form').submit();
    });
});
