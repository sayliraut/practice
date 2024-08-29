<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="{{ asset('public/assets/css/light/custom.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/light/plugins/src/table/datatables.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/assets/css/light/plugins/src/table/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/assets/css/light/plugins/src/table/custom_dt_custom.css') }}">
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('public/assets/css/light/plugins/src/table/datatables.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.3/apexcharts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <style>
        #delete-customer-user-modal {
            display: none;
        }
    </style>
</head>

<body>

    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="row layout-top-spacing">
                <div class="top-tabel">
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="card-title">Manage Users</h6>
                        </div>
                        <div class="col-md-8">
                        </div>
                    </div>
                </div>
                <button>
                    <a class="extra-btn width-max-content" 
                        href="{{ route('add_user') }}">Add</a>
                </button>
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-8 position-btn" style="overflow: auto;">
                        <form action="" method="POST" id="restaurant-form">
                            @csrf
                            <input type="hidden" name="selected_id" id="ids" disabled>
                            <input type="hidden" name="all_id" id="all_id" value="all" disabled>
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th class="w-10px pe-2">
                                            <div
                                                class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" id="select-all-ids" />
                                            </div>
                                        </th>
                                        <th class="text-center">Sr no</th>
                                        <th class="text-center">User Name</th>
                                        <th class="text-center">Date of Birth</th>
                                        <th class="text-center">Gender</th>
                                        <th class="text-center">State</th>
                                        <th class="text-center">City</th>
                                        <th class="text-center no-content">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @php($count = 0)
                                    @foreach ($users as $user)
                                        @php($count++)
                                        <tr>
                                            <td>
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input restaurant-checkbox" type="checkbox"
                                                        name="restaurant_ids" value="{{ $user->id }}" />
                                                </div>
                                            </td>
                                            <td class="text-center">{{ $count }}</td>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->date_of_birth }}</td>
                                            <td class="text-center">{{ $user->gender }}</td>
                                            <td class="text-center">{{ $user->state->name }}</td>
                                            <td class="text-center">{{ $user->city->name }}</td>
                                            <td class="actions text-center">
                                                <a href="{{ url('/view_user/' . $user->id) }}">
                                                    <img src="{{ asset('public/assets/css/light/img/view.svg') }}"
                                                        alt="View" title="View" style="width: 20px;" />
                                                </a>
                                                <a href="{{ url('/edit_user/' . $user->id) }}">
                                                    <img src="{{ asset('public/assets/css/light/img/edit.svg') }}"
                                                        alt="Edit" title="Edit" style="width: 20px;" />
                                                </a>
                                                <a href="#" class="delete-customer-user"
                                                    data-id="{{ $user->id }}" alt="Delete" title="Delete"
                                                    data-toggle="modal" data-target="#delete-customer-user-modal">
                                                    <img src="{{ asset('public/assets/css/light/img/delete-recycle.svg') }}"
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
    <script>
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
    </script>
</body>

</html>
