$(document).on("click", "#update_restaurant_btn", function (e) {
    $('#update_restaurant_form').validate({
        ignore: [],
        debug: false,
        rules: {
            name: {
                required: true
            },
            description: {
                required: true,
            },
            rest_id: {
                required: true,
            },
            city: {
                required: true,
            },
            bio:{
                required: true
            },
            try_on_1:{
                required: true,
            },
            try_on_2:{
                required: true,
            },
            try_on_3:{
                required: true,
            },
            try_on_4:{
                required: true,
            },
        
        },
        messages: {
            name: {
                required: "Enter restaurant Name",
            },
            description: {
                required: "Enter Description",
            },
            rest_id: {
                required: "Enter restaurant Id",
            },
            city: {
                required: "Please Select location",
            },
            bio:{
                required: "Enter Bio ", 
            },
            try_on_1:{
                required: "Please enter this field", 
            },
            try_on_2:{
                required: "Please enter this field", 
            },
            try_on_3:{
                required: "Please enter this field", 
            },
            try_on_4:{
                required: "Please enter this field", 
            },
        },
        errorClass: 'error-message',
        submitHandler: function(form) {
            var formData = new FormData(form);
            let base_url = url_path;
            e.preventDefault(),
            $('#update_restaurant_btn').text('Please wait...');
            $('#update_restaurant_btn').attr('disabled', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: base_url + '/update_restraunt',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {

                    if (result.status_code == 200) {
                        toastr.success('Restaurant Updated Sucessfully');
                        setTimeout(function() {
                            window.location.href = base_url + "/manage_restraunt";
                        }, 2000);
                    } else {
                        toastr.error('Something Went Wrong');
                        setTimeout(function() {
                            window.location.href = base_url + "/manage_restraunt";
                        }, 2000);
                    }
                    $('#update_restaurant_btn').attr('disabled', false);
                    $('#update_restaurant_btn').text('Submit');
                },
               
            });

            $('#update_restaurant_btn').attr('disabled', false);
                    $('#update_restaurant_btn').text('Submit');
        }
    });
});