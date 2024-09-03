$(document).ready(function () {
    // Variables to store the selected FAQ data
   // Variables to store the selected FAQ data
var faqId, faqQuestion, faqAnswer, faqCategoryId;

// Event handler for clicking "Edit" button
$('.edit-faq-btn').on('click', function (e) {
    e.preventDefault();

    // Fetch data from the clicked "Edit" button
    faqId = $(this).data('faq-id');
    faqQuestion = $(this).data('faq-question');
    faqAnswer = $(this).data('faq-answer');
    faqCategoryId = $(this).data('faq-category-id');

    // Populate the form fields in the edit modal
    $('#edit-faq-modal').find('#edit-question').val(faqQuestion);
    $('#edit-faq-modal').find('#edit-answer').val(faqAnswer);
    $('#edit-faq-modal').find('#edit_faq_category').val(faqCategoryId);

    // Show the modal
    $('#edit-faq-modal').modal('show');
});

    // Event handler for submitting the form
    $('#edit_faq').validate({
        rules: {
            question: {
                required: true,
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
            },
            answer: {
                required: "Please enter the answer.",
            },
            faq_categ: {
                required: "Please select the category"
            },
        },
        errorClass: 'error-message',
        submitHandler: function (form) {
            var formData = new FormData(form);

            // Append the faqId to the FormData
            formData.append('faq_id', faqId);

            // Make AJAX request
            $.ajax({
                url: url_path + '/update_faq',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == 200) {
                        toastr.success('Faq Updated successfully');
                        // Close the modal
                        $('#edit-faq-modal').modal('hide');
                        setTimeout(function () {
                            window.location.href = url_path + "/faq";
                        }, 1000);
                    } else {
                        toastr.error("Something went wrong");
                    }
                },
            });
        }
    });
});
