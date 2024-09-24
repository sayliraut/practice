
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Practice Project</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('public/assets/img/logo.png')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" >
    <link href="{{ asset('public/assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
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
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/plugins/css/light/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/plugins/css/light/table/datatable/custom_dt_custom.css')}}">
    <script src={{ asset('public/assets/js/apps/chat.js') }}></script>
    <script src={{ asset('public/assets/plugins/src/stepper/bsStepper.min.js') }}></script>
    <script src={{ asset('public/assets/plugins/css/dark/stepper/custom-bsStepper.min.js') }}></script>
    <script type="text/javascript" src={{ asset('public/assets/plugins/src/global/vendors.min.js') }}></script>
    <script type="text/javascript" src={{ asset('public/assets/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <script type="text/javascript" src={{ asset('public/assets/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}>
    <script type="text/javascript" src={{ asset('public/assets/plugins/src/mousetrap/mousetrap.min.js') }}></script>
    <script type="text/javascript" src={{ asset('public/assets/plugins/src/waves/waves.min.js') }}>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.3/apexcharts.min.js">
    <script src={{ asset('public/assets/plugins/src/filepond/FilePondPluginFileValidateType.min.js') }}>
    <script src={{ asset('public/assets/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}>
    <script src={{ asset('public/assets/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}>
    <script type="text/javascript" src={{ asset('public/admin-dashboard/assets/css/src/plugins/src/tagify/tagify.min.js') }}></script>

    <link rel="stylesheet" type="text/css" href={{ asset('public/assets/plugins/src/stepper/bsStepper.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('public/assets/plugins/css/dark/stepper/custom-bsStepper.css') }}>











    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
     <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <script>
        url_path = "{{url('/')}}";
        </script>
</head>

<body class="layout-boxed">
