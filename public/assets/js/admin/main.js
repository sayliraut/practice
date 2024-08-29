$(document).on('click', '.delete-customer-user', function(e) {

    var userId = $(this).data('id');

    $('#customer_delete').val(userId);

    $('#delete-customer-user-modal').modal('show');
});


$(document).on('click', '#delete_customer_user', function(e) {
    var userId = $('#customer_delete').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var url_path = "{{ url('/') }}";
    var base_url = url_path;


    $.ajax({
        url: url_path + '/delete_user/' + userId,
        type: 'delete',

        success: function(result) {
            if (result.status == 200) {
                toastr.success('User Deleted Successfully');
                $('#delete-customer-user-modal').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                toastr.error(result.message);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        },
        error: function(xhr) {
            toastr.error('Something Went Wrong');
        }
    });
});
