
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('public/assets/img/logo.png')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link href="../layouts/modern-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" >
    <link href="{{ asset('public/assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="../layouts/modern-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/plugins/src/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/light/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/css/light/custom.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/light/sidebar.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/light/main.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/light/structure.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/light/scrollspyNav.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/light/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/light/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/plugins/src/tagify/tagify.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/plugins/css/light/tagify/custom-tagify.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/plugins/src/filepond/filepond.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/plugins/src/filepond/FilePondPluginImagePreview.min.css')}}">
    <link href="{{asset('public/assets/plugins/css/light/filepond/custom-filepond.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/plugins/src/table/datatable/datatables.css')}}">
    <link rel="sty lesheet" type="text/css" href="{{asset('public/assets/plugins/css/light/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/plugins/css/light/table/datatable/custom_dt_custom.css')}}">
    <!-- added by abhishek -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
     <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
     <script>
        url_path = "{{url('/')}}";
        </script>
</head>

<body class="layout-boxed">

    <!-- BEGIN LOADER -->
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>
<!--  END LOADER -->

<div class="auth-container d-flex signup">
    @yield('content')
</div>

    <div class="footer-wrapper">
    </div>
    @yield('scripts')
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
    <script src="{{ asset('public/assets/plugins/src/filepond/FilePondPluginImageTransform.min.js')}}"></script>
    <script src="{{ asset('public/assets/plugins/src/filepond/filepondPluginFileValidateSize.min.js')}}"></script>
    <script src="{{ asset('public/assets/plugins/src/filepond/custom-filepond.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- added by abhishek -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    </body>

    </html>
