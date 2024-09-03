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
        { "orderable": false, "targets": [0,5, 6] } // Disable ordering for the first column (checkboxes) and the eighth column
    ]
});

$(".cust_passport_table").on("change", ".active_cust_passport", function () {
    let base_url = url_path;
    var status = $(this).prop("checked") == true ? 1 : 0;
    var passport_id = $(this).data("id");
    $.ajax({
        type: "GET",
        dataType: "json",
        url: base_url + '/change_cust_pass_Status',
        data: {
            status: status,
            passport_id: passport_id,
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

$(document).on("click", ".cust_pass_btn", function () {
    var delete_id = $(this).data('id');
    $('#delete_cust_passport_id').val(delete_id);
});

$(document).on("click", ".delete_cust_passport_btn", function (e) {
    e.preventDefault();
    let base_url = url_path;
    var delete_id = $('#delete_cust_passport_id').val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "DELETE",
        url: base_url + "/delete_cust_passport/" + delete_id,
        success: function (response) {
            if (response.status == 200) {
                toastr.success('Passport Deleted Successfully');
                setTimeout(function () {
                    window.location.href = base_url + "/manage_passport";
                }, 1000);
            } else {
                toastr.error("Something went wrong");
            }
        },
    });
});