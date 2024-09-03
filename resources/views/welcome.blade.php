@extends('Admin.layouts.master')
@section('content')
    @php
        $currentPage = 'dashboard';
    @endphp


    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="row layout-top-spacing">
                <div class="top-tabel">
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="card-title">Manage Users</h6>
                        </div>
                    </div>
                </div>



                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-8 position-btn" style="overflow: auto;">
                        <form action="{{ route('export-selected-user') }}" method="POST" id="user-form">
                            @csrf
                            <input type="hidden" name="all_id" id="all_id" value="all" disabled>
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" id="select-all-ids" />
                                            </div>
                                        </th>
                                        <th class="text-center">Sr no</th>
                                        <th class="text-center">User Name</th>
                                        <th class="text-center">Date of Birth</th>
                                        <th class="text-center">Gender</th>
                                        <th class="text-center">Email Address</th>
                                        <th class="text-center">Phone Number</th>
                                        <th class="text-center">State</th>
                                        <th class="text-center">City</th>
                                        <th class="text-center">Created At</th>
                                        <th class="text-center no-content">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @php($count = 0)
                                    @foreach ($users as $user)
                                        @php($count++)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input restaurant-checkbox" type="checkbox"
                                                        name="user_ids[]" value="{{ $user->id }}" />

                                                </div>
                                            </td>
                                            <td class="text-center">{{ $count }}</td>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->date_of_birth }}</td>
                                            <td class="text-center">{{ $user->gender }}</td>
                                            <td class="text-center">{{ $user->email_address }}</td>
                                            <td class="text-center">{{ $user->phone_number }}</td>
                                            <td class="text-center">{{ $user->state->name }}</td>
                                            <td class="text-center">{{ $user->city->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('m/d/Y H:i') }}
                                            </td>
                                            <td class="actions text-center">
                                                <a href="{{ url('/view_user/' . $user->id) }}">
                                                    <img src="{{ asset('public/assets/img/view.svg') }}" alt="View"
                                                        title="View" style="width: 20px;" />
                                                </a>
                                                <a href="{{ url('/edit_user/' . $user->id) }}">
                                                    <img src="{{ asset('public/assets/img/edit.svg') }}" alt="Edit"
                                                        title="Edit" style="width: 20px;" />
                                                </a>
                                                <a href="#" class="delete-customer-user"
                                                    data-id="{{ $user->id }}" alt="Delete" title="Delete"
                                                    data-toggle="modal" data-target="#delete-customer-user-modal">
                                                    <img src="{{ asset('public/assets/img/delete-recycle.svg') }}"
                                                        style="width: 20px;" />
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-customer-user-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <p class="modal-text" style="text-align:center;">Are you sure you want to<br>Delete</p>
                    <input type="hidden" id="customer_delete">
                    <div class="modal-btn d-flex ">
                        <a class="extra-btn" href="#" data-dismiss="modal">No</a>
                        <a class="download-btn-custom" id="delete_customer_user" href="#">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('section_script')
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
            "pageLength": 10,
            "ordering": true
        });

        $(document).ready(function() {
            var exportButton = `
    <div class="dropdown-menu">
        <button>
            <a class="extra-btn width-max-content" href="{{ route('add_user') }}">Add</a>
        </button>
        <button type="button" id="download_all">Download Overview</button>
        <button type="button" id="download-selected">Download Selected</button>
    </div>
    `;

            $(document).ready(function() {
                $('<button><a class="extra-btn width-max-content" href="{{ route('add_user') }}">Add</a></button><button><ul class="navbar-item flex-row ms-lg-auto ms-0"><li class="nav-item dropdown action-dropdown  order-lg-0 order-1"><a href="javascript:void(0);"class="nav-link dropdown-toggle user extra-btn" id="actionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><div class="avatar-container"><div class="avatar avatar-sm avatar-indicators avatar-online"><h3>Export</h3></div></div></a><div class="dropdown-menu position-absolute" aria-labelledby="actionDropdown"><div class="dropdown-item"><a href="javascript:void(0)" id="download_all"><span>Download Overview</span></a></div><div class="dropdown-item"><a href="javascript:void(0)" id="download-selected"><span id="export">Download Selected</span></a></div></div></li></ul></button>')
                    .insertBefore("#zero-config_filter label");
            });


            $(exportButton).insertBefore("#zero-config_filter");

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

            $(document).on("click", "#download_all", function(e) {
                $('#all_id').prop('disabled', false);
                $('#ids').prop('disabled', true);
                $('#user-form').submit();
            });

            $(document).on("click", "#download-selected", function(e) {
                e.preventDefault();

                var allIds = [];

                var table = $('#zero-config').DataTable();
                for (var i = 0; i < table.page.info().pages; i++) {
                    table.page(i).draw(false);
                    $('#zero-config tbody input:checked').each(function() {
                        allIds.push($(this).val());
                    });
                }

                if (allIds.length > 0) {
                    // Set the hidden input value to the selected IDs
                    // $('<input>').attr({
                    //     type: 'hidden',
                    //     id: 'ids',
                    //     name: 'user_ids[]',
                    //     value: allIds.join(',')
                    // }).appendTo('#user-form');

                    // Submit the form
                    $('#all_id').prop('disabled', true);
                    $('#user-form').submit();
                } else {
                    toastr.error("Please select at least one customer to download.");
                }
            });
        });
    </script>
@endsection
