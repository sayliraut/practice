$(document).ready(function () {
    // Initialize Quill editors
    var quillTitle = new Quill('#referral-rules-quill-edit-title', {
        theme: 'snow'
    });
    var quillMessage = new Quill('#referral-rules-quill-edit-message', {
        theme: 'snow'
    });
    var quillReferral = new Quill('#referral-rules-quill-edit-what_is_referral', {
        theme: 'snow'
    });

    // Set initial content for Quill editors
    quillTitle.clipboard.dangerouslyPasteHTML($('#stored-title-message').val());
    quillMessage.clipboard.dangerouslyPasteHTML($('#stored-message-message').val());
    quillReferral.clipboard.dangerouslyPasteHTML($('#stored-referral-message').val());

    // Form submission logic
    $('#referral_update_rules').on("click", function (e) {
        e.preventDefault();

        $('#referral_rules_form').validate({
            ignore: [],
            debug: false,
            rules: {
                how_it_works: {
                    required: true,
                    minlength: 10,
                },
                rules: {
                    required: true,
                    minlength: 10,
                },
                what_is_referral: {
                    required: true,
                    minlength: 10,
                }
            },
            messages: {
                how_it_works: {
                    required: "Please enter How it works",
                    minlength: "Please enter at least 10 characters"
                },
                rules: {
                    required: "Please enter the Rules",
                    minlength: "Please enter at least 10 characters"
                },
                what_is_referral: {
                    required: "Please enter What is referral",
                    minlength: "Please enter at least 10 characters"
                }
            },
            errorClass: 'error-message',
            submitHandler: function (form) {
                function base64Encode(str) {
                    return btoa(unescape(encodeURIComponent(str)));
                }
                // Encode the content from Quill editors
                var encodedTitle = base64Encode(quillTitle.root.innerHTML);
                var encodedMessage = base64Encode(quillMessage.root.innerHTML);
                var encodedReferral = base64Encode(quillReferral.root.innerHTML);

                // Update hidden inputs with the encoded content
                $('input[name="how_it_works"]').val(encodedTitle);
                $('input[name="rules"]').val(encodedMessage);
                $('input[name="what_is_referral"]').val(encodedReferral);

                let base_url = url_path;

                var formData = new FormData(form);

                $.ajax({
                    url: base_url + '/update_referral_rules',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    success: function (response) {
                        if (response.status == 200) {
                            toastr.success(
                                'Rules Data Updated Successfully');
                            setTimeout(function () {
                                window.location.href =
                                base_url + '/manage_referral_rules';
                            }, 1000);
                        } else {
                            toastr.error("Something went wrong");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error: ', status, error);
                        toastr.error(
                            "An error occurred while updating the rules"
                        );
                    }
                });
            }
        });

        // Trigger form validation
        $('#referral_rules_form').submit();
    });
});
