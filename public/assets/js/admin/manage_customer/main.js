
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
    "pageLength": 10,
    "ordering": true, // Enable global ordering
    "columnDefs": [
        // { "orderable": false, "targets": [0, 1, 2] } // Disable ordering for the first column (checkboxes) and the eighth column
    ]
});

$(document).ready(function() {
    $('<button><ul class="navbar-item flex-row ms-lg-auto ms-0"><li class="nav-item dropdown action-dropdown  order-lg-0 order-1"><a href="javascript:void(0);" class="nav-link dropdown-toggle user extra-btn" id="actionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><div class="avatar-container"><div class="avatar avatar-sm avatar-indicators avatar-online"><h3>Export</h3></div></div></a><div class="dropdown-menu position-absolute" aria-labelledby="actionDropdown"><div class="dropdown-item"><a href="javascript:void(0)" id="download_all"><span>Download Overview</span></a></div><div class="dropdown-item"><a href="javascript:void(0)" id="download-selected"><span id="export">Download Selected</span></a></div></div></li></ul></button>')
        .insertBefore("#zero-config_filter label");
});

$(document).on("click", ".cust_archive_btn", function () {
    var data_id = $(this).data('id');
    $('#archive_id').val(data_id);
});

$(document).on("click", ".customer_archive", function (e) {
    e.preventDefault();
    let base_url = url_path;
    var archive_id = $('#archive_id').val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "DELETE",
        url: base_url + "/manage_customer_archive/" + archive_id,
        success: function (response) {
            if (response.status == 200) {
                toastr.success('Record has been archive');
                setTimeout(function () {
                    window.location.href = base_url + "/manage-customer";
                }, 1000);
            } else {
                toastr.error("Something went wrong");
            }
        },
    });
});

// For Un-archive

$(document).on("click", ".cust_unarchive_btn", function () {
    var data_id = $(this).data('id');
    $('#unarchive_id').val(data_id);
});

$(document).on("click", ".customer_unarchive", function (e) {
    e.preventDefault();
    let base_url = url_path;
    var archive_id = $('#unarchive_id').val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: base_url + "/manage_customer_unarchive/" + archive_id,
        success: function (response) {
            if (response.status == 200) {
                toastr.success('The user has been unarchived.');
                setTimeout(function () {
                    window.location.href = base_url + "/manage-customer";
                }, 1000);
            } else {
                toastr.error("Something went wrong");
            }
        },
    });
});

$(function (e) {
    $("#select-all-ids").click(function () {
        $(".form-check-input").prop('checked', $(this).prop('checked'));
    });

    $(".form-check-input").click(function () {
        if (!$(this).prop('checked')) {
            $("#select-all-ids").prop('checked', false);
        } else {
            if ($(".form-check-input:checked").length === $(".form-check-input").length) {
                $("#select-all-ids").prop('checked', true);
            }
        }
    });

    $(document).on("click", "#download-selected", function (e) {
        e.preventDefault();

        var allIds = [];

        // Iterate over each page of the DataTable
        var table = $('#zero-config').DataTable();
        for (var i = 0; i < table.page.info().pages; i++) {
            table.page(i).draw(false); // Switch to page i
            $('#zero-config tbody input:checked').each(function () {
                allIds.push($(this).val());
            });
        }

        if (allIds.length > 0) {
            // If there are selected customers
            $('#ids').prop('disabled', false);
            $('#all_id').prop('disabled', true);
            $('#ids').val(allIds);
            // Now submit the form or perform download action
            $('#customer-form').submit();
            //   console.log(allIds);
            //    return;
            // Or perform your download action here
        } else {
            // No customers selected
            toastr.error("Please select at least one customer to download.");
        }
    });

    $(document).on("click", "#download_all", function (e) {
        $('#all_id').prop('disabled', false);
        $('#ids').prop('disabled', true);
    })
});

$(document).on("click", ".more", function (e) {
    e.preventDefault();
    e.stopPropagation();

});


$(document).on('click', "#delete_customer_user_id", function() {
    var delete_customer_user_id = $(this).data('id');
    $("#customer_delete").val(delete_customer_user_id);
})

$(document).on('click', '#delete_customer_user', function(e) {
    let base_url = url_path;
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var id = $('#customer_delete').val();

    $('#delete_customer_user').text('Please wait...');
    $('#delete_customer_user').attr('disabled', true);

    $.ajax({
        type: 'POST',
        url: 'delete_customer_user/' + id,
        success: function(result) {
            if (result.status == 200) {
                toastr.success('Customer Deleted Sucessfully');
                setTimeout(function() {
                    window.location.href = base_url + "/manage-customer";
                }, 2000);
            } else {
                toastr.error('Something Went Wrong');
                setTimeout(function() {
                    window.location.href = base_url + "/manage-customer";
                }, 2000);
            }
        }
    });
});

$(document).on('click', "#unsubscribe_id", function() {
    var unsubscribe_id = $(this).data('id');
    $("#unsubscribe_id").val(unsubscribe_id);
})

$(document).on('click', '#unsubscibed', function(e) {
    let base_url = url_path;
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var id = $('#unsubscribe_id').val();

    $('#unsubscibed').text('Please wait...');
    $('#unsubscibed').attr('disabled', true);

    $.ajax({
        type: 'POST',
        url: 'unsubscibed/' + id,
        success: function(result) {
            if (result.status == 200) {
                toastr.success('Customer Unsubscribed Sucessfully');
                setTimeout(function() {
                    window.location.href = base_url + "/manage-customer";
                }, 2000);
            } else {
                toastr.error('Something Went Wrong');
                setTimeout(function() {
                    window.location.href = base_url + "/manage-customer";
                }, 2000);
            }
        }
    });
});
