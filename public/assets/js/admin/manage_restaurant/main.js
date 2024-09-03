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

// For Archive

$(document).on("click", ".rest_archive_btn", function () {
    var data_id = $(this).data('id');
    $('#restaurants_id').val(data_id);
});

$(document).on("click", ".restaurants_archive", function (e) {
    e.preventDefault();
    let base_url = url_path;
    var archive_id = $('#restaurants_id').val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "DELETE",
        url: base_url + "/manage_restaurants_archive/" + archive_id,
        success: function (response) {
            if (response.status == 200) {
                toastr.success('Record has been archive');
                setTimeout(function () {
                    window.location.href = base_url + "/restaurant_users";
                }, 1000);
            } else {
                toastr.error("Something went wrong");
            }
        },
    });
});

// For Un-archive

$(document).on("click", ".rest_unarchive_btn", function () {
    var data_id = $(this).data('id');
    $('#unarchive_id').val(data_id);
});

$(document).on("click", ".restaurant_unarchive", function (e) {
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
        url: base_url + "/manage_restaurants_unarchive/" + archive_id,
        success: function (response) {
            if (response.status == 200) {
                toastr.success('Record has been');
                setTimeout(function () {
                    window.location.href = base_url + "/restaurant_users";
                }, 1000);
            } else {
                toastr.error("Something went wrong");
            }
        },
    });
});

$(document).on('click', "#delete_restaurant", function() {
    var delete_restaurant_user_id = $(this).data('id');
    $("#news_delete").val(delete_restaurant_user_id);
})

$(document).on('click', '#delete_restaurant_user', function(e) {
    let base_url = url_path;
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var id = $('#news_delete').val();
    console.log('id' , id);
    $('#delete_restaurant_user').text('Please wait...');
    $('#delete_restaurant_user').attr('disabled', true);

    $.ajax({
        type: 'POST',
        url: base_url + '/delete_restaurant_user/' + id,
        success: function(result) {
            if (result.status == 200) {
                toastr.success('Restaurant Deleted Sucessfully');
                setTimeout(function() {
                    window.location.href = base_url + "/restaurant_users";
                }, 2000);
            } else {
                toastr.error('Something Went Wrong');
                setTimeout(function() {
                    window.location.href = base_url + "/restaurant_users";
                }, 2000);
            }
        }
    });
});



$(document).ready(function() {
    let actionType = '';
    let restUserId = '';
    let switchElement = null;
    let actionButton = null;

    $(".approve-btn, .disapprove-btn").on("click", function(e) {
        e.preventDefault();

        actionType = $(this).hasClass('approve-btn') ? 'approve' : 'disapprove';
        restUserId = $(this).data("id");
        switchElement = $('#switch' + restUserId);
        actionButton = $(this);

        // Check current status for approve
        if (actionType === 'approve' && switchElement.prop('checked')) {
            toastr.options = { "timeOut": 100 };
            toastr.warning("User is already approved. !!");
            return;
        }

        // Check current status for disapprove
        if (actionType === 'disapprove' && $(this).data("deleted_by_admin") == 1) {
            toastr.options = { "timeOut": 500 };
            toastr.warning("User is already disapproved. !!");
            return;
        }

        $('#action-type').text(actionType);
        $('#action-word').text(actionType);
        $('#confirm-btn').attr('data-action', actionType);
        $('#confirm-btn').attr('data-id', restUserId);
        $('#confirm-modal').modal('show');
    });

    $('#confirm-btn').on('click', function() {
        let base_url = url_path;
        let actionType = $(this).attr('data-action');
        let restUserId = $(this).attr('data-id');

        $(this).text('Please wait...').attr('disabled', true);

        $.ajax({
            type: "POST",
            dataType: "json",
            url: base_url + '/change_rest_status',
            data: {
                status: actionType === 'approve' ? 1 : 0,
                rest_user_id: restUserId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                toastr.options = { "timeOut": 500 };
                if (actionType === 'approve') {
                    toastr.success("User approved and status activated successfully. !!");
                    switchElement.prop('checked', true);
                } else {
                    toastr.error("User disapproved and status deactivated successfully. !!");
                    switchElement.prop('checked', false);
                }
                setTimeout(function() {
                    window.location.href = base_url + "/restaurant_users";
                }, 2000);
            },
            error: function() {
                toastr.error("There was an error processing the request. Please try again.");
                $('#confirm-btn').text('Yes, ' + actionType).attr('disabled', false);
            }
        });

        $('#confirm-modal').modal('hide');
    });
});




            // Handle switch change
            $(".rest_users_table").on("change", ".active_rest_user", function() {
                // Revert the switch change
                var currentStatus = $(this).prop("checked");

                // Revert the switch state
                $(this).prop("checked", !currentStatus);


                toastr.options = {
                    "timeOut": 500
                }
                toastr.error("You can only change the status using Approve/Disapprove buttons.");
            });


            $(function(e) {
                // Select/Deselect all checkboxes
                $("#select-all-ids").click(function() {
                    $(".form-check-input").prop('checked', $(this).prop('checked'));
                });

                $(".form-check-input").click(function() {
                    if (!$(this).prop('checked')) {
                        $("#select-all-ids").prop('checked', false);
                    } else {
                        if ($(".form-check-input:checked").length === $(".form-check-input").length) {
                            $("#select-all-ids").prop('checked', true);
                        }
                    }
                });

                // Handle download selected action
                $(document).on("click", "#download-selected", function(e) {
                    e.preventDefault();

                    var selectedIds = [];

                    var table = $('#zero-config').DataTable();
                    for (var i = 0; i < table.page.info().pages; i++) {
                        table.page(i).draw(false); // Switch to page i without resetting the table
                        $('#zero-config tbody input.form-check-input:checked').each(function() {
                            selectedIds.push($(this).val());
                        });
                    }

                    if (selectedIds.length > 0) {
                        // If there are selected customers
                        $('#selected_ids').prop('disabled', false);
                        $('#all_id').prop('disabled', true);
                        $('#selected_ids').val(selectedIds.join(',')); // Join all IDs into a single string

                        // Log the selected IDs for debugging
                        // console.log(selectedIds);

                        $('#restaurant-form').submit();

                        setTimeout(function() {
                            location.reload();
                        }, 5000); // Adjust the timeout as needed
                    } else {
                        toastr.error("Please select at least one restaurant to download.");
                    }
                });

                // Handle download all action
                $(document).on("click", "#download_all", function(e) {
                    e.preventDefault();
                    $('#all_id').prop('disabled', false);
                    $('#selected_ids').prop('disabled', true);
                    $('#restaurant-form').submit();

                    setTimeout(function() {
                        location.reload();
                    }, 5000); // Adjust the timeout as needed
                });
            });
