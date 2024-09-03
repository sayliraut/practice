$(".sub_admin_permission").click(function () {
    var id = $(this).data("id");
    let base_url = url_path;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        dataType: "json",
        url: base_url + '/get_sub_admin_permission',
        data: {
            id: id
        },
        success: function (data) {
            if (data.success && data.data) {
                // Uncheck all checkboxes
                $("#premission-modal input[name='module_id[]']").prop("checked", false);
                // Loop through each response data
                $.each(data.data, function (index, permission) {
                    $("#premission-modal input[name='module_id[]'][value='" + permission.manage_modules_xid + "']").prop("checked", true);
                    $('#premission-modal').modal('show');
                });
            }
        },
    });
});

$(document).on("click", ".admin_delete_btn", function () {
    var data_id = $(this).data('id');
    $('#sub_admin_delete').val(data_id);
});

$(document).on("click", ".admin_delete", function (e) {
    e.preventDefault();
    let base_url = url_path;
    var archive_id = $('#sub_admin_delete').val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "DELETE",
        url: base_url + "/manage_sub_admin/" + archive_id,
        success: function (response) {
            if (response.status == 200) {
                toastr.success('Deleted Successfully');
                setTimeout(function () {
                    window.location.href = base_url + "/manage-sub-admin";
                }, 1000);
            } else {
                toastr.error("Something went wrong");
            }
        },
    });
});

$(".sub_admin_table").on("change", ".active_admin", function () {
    let base_url = url_path;
    var status = $(this).prop("checked") == true ? 1 : 0;
    var passport_id = $(this).data("id");
    $.ajax({
        type: "GET",
        dataType: "json",
        url: base_url + '/change_admin_status',
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
