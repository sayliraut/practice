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
    $('<button><a class="extra-btn width-max-content" href="archive-manage-customers.php">View Archive List</a></button><button><ul class="navbar-item flex-row ms-lg-auto ms-0"><li class="nav-item dropdown action-dropdown  order-lg-0 order-1"><a href="javascript:void(0);"class="nav-link dropdown-toggle user extra-btn" id="actionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><div class="avatar-container"><div class="avatar avatar-sm avatar-indicators avatar-online"><h3>Export</h3></div></div></a><div class="dropdown-menu position-absolute" aria-labelledby="actionDropdown"><div class="dropdown-item"><a href="#"><span>Download Overview</span></a></div><div class="dropdown-item"><a href="#"><span>Download Patient Data</span></a></div><div class="dropdown-item"><a href="#"> <span>Download Selected</span></a></div></div></li></ul></button>')
        .insertBefore("#zero-config_filter label");
});

var quill = new Quill('#news-quill-edit', {
    theme: 'snow'
});

$('#update_news_btn').on("click", function(e) {
    $('#update_news').validate({
        debug: false,
        rules: {
            article_name: {
                required: true
            },
            article_dis: {
                required: true
            },
            category_xid: {
                required: true
            },
            // article_image: {
            //     required: true
            // },
            // article_thmb: {
            //     required: true
            // },
        },

        messages: {
            article_name: {
                required: "Please Enter Article name"
            },
            article_dis: {
                required: "Please Enter Description"
            },
            category_xid: {
                required: "Please Enter Category"
            },
            // article_image: {
            //     required: "Please select image"
            // },
            // article_thmb: {
            //     required: "Please select image"
            // },
        },
        errorClass: 'error-message',
        submitHandler: function(form) {
            // Set the hidden input value to the HTML content of the Quill editor
            var quillContent = quill.root.innerHTML;
            $('#article_dis').val(quillContent);

            let base_url = url_path;
            var formData = new FormData(form);
            $('#update_news_btn').text('Please wait...');
            $('#update_news_btn').attr('disabled', true);
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                url: base_url + '/manage_update_news',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == 200) {
                        toastr.success('News and Article Updated Successfully');
                        setTimeout(function() {
                            window.location.href = base_url +
                                "/manage-new-articles";
                        }, 1000);
                    } else if (response.status == 204) {
                        toastr.error(response.error);
                    } else {
                        toastr.error("Something went wrong");
                    }
                    $('#update_news_btn').attr('disabled', false);
                    $('#update_news_btn').text('Submit');
                },
            });
        }
    });
});



const imageInputEdit = document.getElementById('imageInputNormal');
const imagePreviewEdit = document.getElementById('imageInputPreviewNormal');

imageInputEdit.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const img = document.createElement('img');
            img.src = event.target.result;
            img.style.maxWidth = '200px';
            img.style.maxHeight = '200px';
            imagePreviewEdit.innerHTML = '';
            imagePreviewEdit.appendChild(img);
        };
        reader.readAsDataURL(file);
    } else {
        imagePreviewEdit.innerHTML = '';
    }
});


const imageInput = document.getElementById('imageInputThumb');
const imagePreview = document.getElementById('imagePreviewThumb');

imageInput.addEventListener('change', function() {
    console.log("in change kjbck");
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const img = document.createElement('img');
            img.src = event.target.result;
            img.style.maxWidth = '200px';
            img.style.maxHeight = '200px';
            imagePreview.innerHTML = '';
            imagePreview.appendChild(img);
        };
        reader.readAsDataURL(file);
    } else {
        imagePreview.innerHTML = '';
    }
});


FilePond.registerPlugin(
    FilePondPluginImagePreview,
    FilePondPluginImageExifOrientation,
    FilePondPluginFileValidateSize,
);
FilePond.create(
    document.querySelector('.pan-frontside')
);