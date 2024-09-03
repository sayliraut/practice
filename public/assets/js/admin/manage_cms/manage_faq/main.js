$('#zero-config').DataTable({
    "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
    "oLanguage": {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
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
    // Insert Add button
    $('<button><a class="extra-btn width-max-content" data-toggle="modal" data-target="#add_faq_modal" href="">Add</a></button>')
        .insertBefore("#zero-config_filter label");

    // Insert Filter dropdown
    $('<select id="filter" class="form-control"><option value="all">All</option><option value="1">Customer</option><option value="2">Restaurant</option><option value="3">Subscription</option></select>')
        .insertBefore("#zero-config_filter label");

    // Filter FAQ
    $('#filter').on('change', function() {
        var filterValue = $(this).val();
        filterFAQs(filterValue);
    });

    function filterFAQs(filterValue) {
        if (filterValue === "all") {
            $("#faq-tbody tr").show();
        } else {
            $("#faq-tbody tr").each(function() {
                var category = $(this).find('td:eq(3)').text().trim();
                if ((filterValue == 1 && category === 'Customer') || (filterValue == 2 && category === 'Restaurant')  || (filterValue == 3 && category === 'Subscription')) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    }
});

// change status
$(".switch-btn").on("change", ".active_newsletter", function () {
    let base_url = url_path;
    var status = $(this).prop("checked") == true ? 1 : 0;
    var program_id = $(this).data("id");
    $.ajax({
        type: "GET",
        dataType: "json",
        url: base_url + '/change_faq_Status',
        data: {
            status: status,
            program_id: program_id,
        },
        success: function (data) {
            if (status == 1) {
                toastr.options = {
                    "timeOut": 500
                }
                toastr.success("Status Activate successfully. !!");
            } else {
                toastr.error("Status Deactivate successfully. !!");
            }
        },
    });
});




//new delete with modal
$(document).on("click", ".delete_about", function () {
    var delete_id = $(this).data('faq-id'); // Corrected this line
    $('#delete_about_id').val(delete_id);
});

$(document).on("click", ".delete_about_button", function (e) {
    e.preventDefault();
    let base_url = url_path;
    var faqId = $('#delete_about_id').val(); // Ensure you're getting the correct ID

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "DELETE",
        url: base_url + "/delete_faq/" + faqId,
        success: function (response) {
            if(response.success) {
                toastr.success("FAQ successfully deleted");
                window.location.href = base_url + "/faq";
            } else {
                toastr.error(response.message);
            }
        },
        error: function (response) {
            toastr.error("An error occurred while deleting the FAQ");
        }
    });
});
//end delete