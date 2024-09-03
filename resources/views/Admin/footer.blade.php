<div class="footer-wrapper">
    <div class="footer-section f-section-1">
        <p class="">Copyright © <span class="dynamic-year">2024</span>All rights reserved.</p>
    </div>
</div>
<script src="../layouts/modern-light-menu/loader.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.3/apexcharts.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('public/assets/plugins/src/global/vendors.min.js')}}"></script>
<script src="{{ asset('public/assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('public/assets/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{ asset('public/assets/plugins/src/mousetrap/mousetrap.min.js')}}"></script>
<script src="{{ asset('public/assets/plugins/src/waves/waves.min.js')}}"></script>
<script src="{{ asset('public/assets/layouts/modern-light-menu/app.js')}}"></script>
<script src="{{ asset('public/assets/layouts/collapsible-menu/app.js')}}"></script>
<script src="{{ asset('public/assets/js/dashboard/dash_1.js')}}"></script>
<script src="{{ asset('public/assets/js/custom.js')}}"></script>
<script src="{{ asset('public/assets/js/scrollspyNav.js')}}"></script>
<script src="{{ asset('public/assets/js/dashboard/dash_2.js')}}"></script>
<script src="{{ asset('public/assets/plugins/src/tagify/tagify.min.js')}}"></script>
<script src="{{ asset('public/assets/plugins/src/tagify/custom-tagify.js')}}"></script>
<script src="{{ asset('public/assets/plugins/src/filepond/filepond.min.js')}}"></script>
<script src="{{ asset('public/assets/plugins/src/filepond/FilePondPluginFileValidateType.min.js')}}"></script>
<script src="{{ asset('public/assets/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js')}}"></script>
<script src="{{ asset('public/assets/plugins/src/filepond/FilePondPluginImagePreview.min.js')}}"></script>
<script src="{{ asset('public/assets/plugins/src/filepond/FilePondPluginImageCrop.min.js')}}"></script>
<script src="{{ asset('public/assets/plugins/src/filepond/FilePondPluginImageResize.min.js')}}"></script>
<script src="{{ asset('public/assets/plgins/src/filepond/FilePondPluginImageTransform.min.js')}}"></script>
<script src="{{ asset('public/assets/plugins/src/filepond/filepondPluginFileValidateSize.min.js')}}"></script>
<script src="{{ asset('public/assets/plugins/src/filepond/custom-filepond.js')}}"></script>
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- added by abhishek -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="{{asset('public/assets/plugins/src/table/datatable/datatables.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- Custom Js Start Here -->
@yield('section_script')
<script src="{{ asset('assets/js/admin/dashboard/main.js')}}"></script>

<script>
    var dropdown = document.getElementsByClassName("dropdown-btn-users");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }





</script>
<!-- Custom Js End Here -->
</body>

</html>
