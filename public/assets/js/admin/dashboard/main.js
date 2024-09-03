$('#zero-config').DataTable({
    "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
    "oLanguage": {
        "oPaginate": {
            "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
            "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
        },
        "sInfo": "Showing page PAGE of _PAGES_",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Search...",
        "sLengthMenu": "Results :  _MENU_",
    },
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10
});

$('#zero-config2').DataTable({
    "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
    "oLanguage": {
        "oPaginate": {
            "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
            "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
        },
        "sInfo": "Showing page PAGE of _PAGES_",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Search...",
        "sLengthMenu": "Results :  _MENU_",
    },
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10
});


$(document).ready(function() {

    $.validator.addMethod("lettersOnly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Please enter only alphabets");

    $.validator.addMethod("numbersOnly", function(value, element) {
        return this.optional(element) || /^[0-9]+$/.test(value);
    }, "Please enter only numbers");

    $('#create_custom_referral_code').validate({
        rules: {
            referral_code: {
                required: true,
            },

        },
        messages: {
            referral_code: {
                required: "Please enter Referral Code.",
            },

        },
        errorClass: 'error-message',
        submitHandler: function(form) {
            let b_url = url_path;
            $("#create_custom_code").html("Please Wait...");
            $("#create_custom_code").prop("disabled", true);
            let base_url = url_path;

            var formData = new FormData(form);
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"),
                },
                type: "post",
                url: base_url + '/create-update-referral-code',

                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {

                    console.log("result", result);
                    if (result.status_code == 200) {
                        toastr.success('Referral code submitted successfully');
                        setTimeout(function() {
                            window.location.href = b_url +
                                "/dashboard";
                        }, 2000);
                    } else if (result.status_code == 500) {
                        toastr.error(result.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        toastr.error('Something Went Wrong');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                    $('#create_custom_code').attr('disabled', false);
                    $('#create_custom_code').text('Submit');
                },
            });
        }
    });

});


$(function(e) {
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

    $(document).on("click", "#download-selected", function(e) {
        e.preventDefault();

        var allIds = [];

        // Iterate over each page of the DataTable
        var table = $('#zero-config').DataTable();
        for (var i = 0; i < table.page.info().pages; i++) {
            table.page(i).draw(false); // Switch to page i
            $('#zero-config tbody input:checked').each(function() {
                allIds.push($(this).val());
            });
        }

        if (allIds.length > 0) {
            // If there are selected customers
            $('#ids').prop('disabled', false);
            $('#all_id').prop('disabled', true);
            $('#ids').val(allIds);
            // Now submit the form or perform download action
            $('#customer-form').submit(); // Or perform your download action here
        } else {
            // No customers selected
            toastr.error("Please select at least one customer to download.");
        }
    });




    $(document).on("click", "#download_all", function(e) {
        $('#all_id').prop('disabled', false);
        $('#ids').prop('disabled', true);
    })
});

$(document).on("click", ".more", function(e) {
    e.preventDefault();
    e.stopPropagation();
});


$(document).ready(function() {
    // $('<button><ul class="navbar-item flex-row ms-lg-auto ms-0"><li class="nav-item dropdown action-dropdown  order-lg-0 order-1"><a href="javascript:void(0);"class="nav-link dropdown-toggle user extra-btn" id="actionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><div class="avatar-container"><div class="avatar avatar-sm avatar-mid avatar-indicators avatar-online"><h3>Export</h3></div></div></a><div class="dropdown-menu position-absolute" aria-labelledby="actionDropdown"><div class="dropdown-item"><a href="javascript:void(0)" id="download_all"><span>Download Overview</span></a></div><div class="dropdown-item"><a href="javascript:void(0)" id="download-selected"><span id="export">Download Selected</span></a></div></div></li></ul></button>')
    //     .insertBefore("#zero-config_filter label");
    $('<button>' +
        '<ul class="navbar-item flex-row ms-lg-auto ms-0">' +
        '<li class="nav-item dropdown action-dropdown order-lg-0 order-1">' +
        '<a href="javascript:void(0);" class="nav-link dropdown-toggle user extra-btn" id="actionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
        '<div class="avatar-container">' +
        '<div class="avatar avatar-sm avatar-mid avatar-indicators avatar-online">' +
        '<h3>Export</h3>' +
        '</div>' +
        '</div>' +
        '</a>' +
        '<div class="dropdown-menu position-absolute" aria-labelledby="actionDropdown">' +
        '<div class="dropdown-item">' +
        '<a href="javascript:void(0)" id="download_all"><span>Download Overview</span></a>' +
        '</div>' +
        '<div class="dropdown-item">' +
        '<a href="javascript:void(0)" id="download-selected"><span id="export">Download Selected</span></a>' +
        '</div>' +
        '</div>' +
        '</li>' +
        '</ul>' +
        '</button>').insertBefore("#zero-config_filter label");


    $("#zero-config").on("click", ".sub_admin_permission", function() {
        var Name = $(this).data('name');
        var Price = $(this).data('price');
        var SubID = $(this).data('subscription-id');
        var CustID = $(this).data('customer-id');
        var SubStatus = $(this).data('subscription-status');
        var startDate = $(this).data('start-date');
        var endDate = $(this).data('end-date');
        var nextDate = $(this).data('next-date');
        var formattedPrice = '$' + Price;

        $('.subadmin-option span').eq(0).text(Name);
        $('.subadmin-option span').eq(1).text(formattedPrice);
        $('.subadmin-option span').eq(2).text(SubID);
        $('.subadmin-option span').eq(3).text(CustID);
        $('.subadmin-option span').eq(4).text(SubStatus);
        $('.subadmin-option span').eq(5).text(startDate);
        $('.subadmin-option span').eq(6).text(endDate);
        $('.subadmin-option span').eq(7).text(nextDate); // Corrected index for next-date
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.btn-view-details');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const user = JSON.parse(row.dataset.user);
            const referredUsers = JSON.parse(row.dataset.referredUsers);

            // Populate the modal fields
            document.querySelector(
                    '#referral-user-details-modal .referral-user-inn-div:nth-child(1) span')
                .innerText = `${user.first_name} ${user.last_name}`;
            document.querySelector(
                    '#referral-user-details-modal .referral-user-inn-div:nth-child(2) span')
                .innerText = user.email_address;
        //    document.querySelector(
        //             '#referral-user-details-modal .referral-user-inn-div:nth-child(3) span')
        //         .innerText = user.referral_code;

            // Clear previous referred users
            const referredUsersDiv = document.querySelector(
                '#referral-user-details-modal .referral-user-inn-div.referred-users');
            referredUsersDiv.innerHTML = '';

            referredUsers.forEach(referredUser => {
                const p = document.createElement('p');
                p.innerText =
                    `${referredUser.first_name} ${referredUser.last_name} (${referredUser.email_address}) (${referredUser.id})`;
                referredUsersDiv.appendChild(p);
            });
        });
    });
});


