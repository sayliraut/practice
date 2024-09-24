@extends('Admin.layouts.master')

@section('content')
    <?php $currentPage = 'sub-admins'; ?>

    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="row layout-top-spacing ">
                <div class="top-tabel">
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="card-title">Manage Sub Admins</h6>
                        </div>
                        <div class="col-md-8">

                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8 position-btn" style="overflow: auto;">
                        <table id="zero-config" class="table dt-table-hover sub_admin_table" style="width:100%">
                            <thead class="text-center">
                                <th class="text-start">Sr no</th>
                                <th class="text-start">Name</th>
                                <th class="text-start">Email Id</th>
                                <th class="text-start">Created At</th>
                                <th class="text-start">Permission</th>
                                <th class="no-content">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($sub_admins_data as $sub_admins)
                                    <tr>
                                        <td class="text-start">{{ $loop->iteration }}</td>
                                        <td class="text-start">{{ $sub_admins->name }}</td>
                                        <td class="text-start">{{ $sub_admins->email_address }}</td>
                                        <td class="text-start">
                                            {{ \Carbon\Carbon::parse($sub_admins->created_at)->format('m/d/Y') }}</td>
                                        <td class="text-start">
                                            <a class="view-btn m-0 pointer sub_admin_permission" data-toggle="modal"
                                                data-target="#premission-modal" data-id="{{ $sub_admins['id'] }}">View</a>
                                        </td>
                                        <td>
                                            <div class="dropout">
                                                <button class="more">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </button>
                                                <ul>
                                                    <li>
                                                        <div class="switch-btn">
                                                            <input data-id="{{ $sub_admins->id }}"
                                                                {{ $sub_admins->is_active ? 'checked' : '' }}
                                                                class="active_admin" type="checkbox"
                                                                id="switch{{ $sub_admins->id }}" switch="bool" />
                                                            <label for="switch{{ $sub_admins->id }}" data-on-label="Active"
                                                                data-off-label="Expired"></label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/edit_sub_admin/' . $sub_admins->id) }}">
                                                            <img src="{{ asset('public/assets/img/edit.svg') }}" />
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/subadmin_users_mail', $sub_admins->id) }}"
                                                            class="subs-btn">
                                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                            <span>Message</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="" data-toggle="modal" data-target="#delete-modal"
                                                            class="admin_delete_btn" data-id="{{ $sub_admins->id }}">
                                                            <img
                                                                src="{{ asset('public/assets/img/delete-recycle.svg') }}" />
                                                            <span>Delete</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="premission-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 850px;">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="modal-header d-flex justify-content-between modal-title">
                        <h5>View premission</h5>
                        <button type="button pointer" class="btn-close" data-dismiss="modal" aria-label="Close">
                            x
                        </button>
                    </div>
                    <div class="row" style="padding: 0px 10px;">
                        @foreach ($sub_admins_module as $sub_admins_modules)
                            <div class="form-group subadmin-option col-md-4">
                                <input id="customers{{ $sub_admins_modules->id }}" value="{{ $sub_admins_modules->id }}"
                                    type="checkbox" class="form-control" name="module_id[]" disabled>
                                <label for="customers{{ $sub_admins_modules->id }}"
                                    class="label mb-0">{{ $sub_admins_modules->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <p class="modal-text">Are you sure you want to<br>Delete </p>
                    <input type="hidden" id="sub_admin_delete">
                    <div class="modal-btn d-flex ">
                        <a class="extra-btn" href="#" data-dismiss="modal">No</a>
                        <a class="download-btn-custom admin_delete" data-dismiss="modal">Yes</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- Delete-modal --}}
@endsection



@section('section_script')
    {{-- <script src="{{ asset('public/assets/js/admin/manage_customer/main.js')}}"></script>
<script src="{{ asset('public/assets/js/admin/manage_sub_admin/main.js')}}"></script> --}}

    <script>
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
    </script>
    <script>
        $(document).ready(function() {
            $('<button><a class="extra-btn width-max-content" href="{{ route('manage.sub_admin_create') }}">Add</a></button>')
                .insertBefore("#zero-config_filter label");
        });

        $(".sub_admin_permission").click(function() {
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
                success: function(data) {
                    if (data.success && data.data) {
                        // Uncheck all checkboxes
                        $("#premission-modal input[name='module_id[]']").prop("checked", false);
                        // Loop through each response data
                        $.each(data.data, function(index, permission) {
                            $("#premission-modal input[name='module_id[]'][value='" + permission
                                .manage_modules_xid + "']").prop("checked", true);
                            $('#premission-modal').modal('show');
                        });
                    }
                },
            });
        });
    </script>
@endsection
