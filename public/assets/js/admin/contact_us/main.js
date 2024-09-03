$('#zero-config').DataTable({
    "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
    "oLanguage": {
        "oPaginate": {
            "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
            "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
        },
        "sInfo": "Showing page _PAGE_ of _PAGES_",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Search...",
        "sLengthMenu": "Results :  _MENU_",
    },
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10
});


$(document).ready(function() {
    // Create the button element with the correct structure
    var downloadButton = $(
        '<button class="extra-btn width-max-content" id="download_all">Download Overview</button>');

    // Insert the button before the #zero-config_filter label
    downloadButton.insertBefore("#zero-config_filter label");

    // Handle the button click event
    $(document).on("click", "#download_all", function(e) {
        e.preventDefault();
        $('#all_id').prop('disabled', false); // Enable the hidden input
        $('#restaurant-form').submit(); // Submit the form
    });
});


$(document).ready(function() {
    $('.view-btn').click(function() {
        var commentId = $(this).data('ids');
        var commentContent = $(this).data('comment');
        $('#comment-content').text(commentContent); // Ensure correct modal content ID
        $('#comment-modal').modal('show'); // Show the modal
    });
});



$(document).on("click", ".delete_feedback", function() {
    var delete_id = $(this).data('id');
    $('#delete_feedback_id').val(delete_id);
});

$(document).on("click", ".delete_feedback_button", function(e) {
    e.preventDefault();
    let base_url = url_path;
    var delete_id = $('#delete_feedback_id').val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: base_url + "/delete_feedback/" + delete_id,
        data: {
            _method: 'post',
        },
        success: function(response) {
            console.log(response);
            toastr.success("Feedback Deleted Successfully");
            window.location.reload();
        }
    });
});
