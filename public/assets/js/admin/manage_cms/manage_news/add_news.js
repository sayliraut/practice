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
    $('<button><a class="extra-btn width-max-content" href="archive-manage-customers.php">View Archive List</a></button><button><ul class="navbar-item flex-row ms-lg-auto ms-0"><li class="nav-item dropdown action-dropdown  order-lg-0 order-1"><a href="javascript:void(0);"class="nav-link dropdown-toggle user extra-btn" id="actionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><div class="avatar-container"><div class="avatar avatar-sm avatar-indicators avatar-online"><h3>Export</h3></div></div></a><div class="dropdown-menu position-absolute" aria-labelledby="actionDropdown"><div class="dropdown-item"><a href="#"><span>Download Overview</span></a></div><div class="dropdown-item"><a href="#"><span>Download Patient Data</span></a></div><div class="dropdown-item"><a href="#"> <span>Download Selected</span></a></div></div></li></ul></button>').insertBefore("#zero-config_filter label");
});

var quill = new Quill('#news-quill-add', {
    theme: 'snow'
});



FilePond.registerPlugin(
    FilePondPluginImagePreview,
    FilePondPluginImageExifOrientation,
    FilePondPluginFileValidateSize,
);
FilePond.create(
    document.querySelector('.pan-frontside'),
    {
            maxFileSize: '3MB',
            acceptedFileTypes: ['image/*']
        }
);


const imageInput = document.getElementById('selectThumbnailImage');
const imagePreview = document.getElementById('previewthumbnailimage');

imageInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            imagePreview.style.display = 'block'; // Show the image preview container
            imagePreview.src = event.target.result; // Set the source of the image preview to the selected image
        };
        reader.readAsDataURL(file);
    } else {
        imagePreview.style.display = 'none'; // Hide the image preview container if no file is selected
    }
});

selectImage.onchange = evt => {
    preview = document.getElementById('preview');
    preview.style.display = 'block';
    const [file] = selectImage.files
    if (file) {
        preview.src = URL.createObjectURL(file)
    }
}


$('#add_newsletter').on("click", function (e) {    
    $('#add_blog_form').validate({
        // ignore: [],
        // debug: false,
        rules: {
            article_name: {
                required: true
            },
            article_dis: {
                required: true,
                quillNotEmpty: true
            },
            article_image: {
                required: true
            },
            article_thmb: {
                required: true
            },
            category: {
                required: true
            },
        },
        messages: {
            article_name: {
                required: "Please Enter Article name"
            },
            article_dis: {
                required: "Please Enter Description"
            },
            article_image: {
                required: "Please Select Image"
            },
            category: {
                required: "Please Select Article Category"
            },
        },
        errorClass: 'error-message',
        submitHandler: function (form) {
            
            var quillContent = quill.root.innerHTML;
            $('#article_des').val(quillContent);base_url = url_path;
            var formData = new FormData(form);
            $('#add_newsletter').text('Please wait...').attr('disabled', true);
            
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                url: base_url + '/manage_insert_news',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == 200) {
                        toastr.success('News and Article Added Successfully');
                        setTimeout(function () {
                            window.location.href = base_url + "/manage-new-articles";
                        }, 1000);
                    } else {
                        toastr.error("Something went wrong");
                    }
                    $('#add_newsletter').attr('disabled', false).text('Submit');
                },
            });
        }
    });
});


       
selectThumbnailImage.onchange = evt => {
    preview = document.getElementById('previewthumbnailimage');
    preview.style.display = 'block';
    const [file] = selectThumbnailImage.files
    if (file) {
        preview.src = URL.createObjectURL(file)
    }
}

selectImage.onchange = evt => {
    preview = document.getElementById('preview');
    preview.style.display = 'block';
    const [file] = selectImage.files
    if (file) {
        preview.src = URL.createObjectURL(file)
    }
}