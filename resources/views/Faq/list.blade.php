@extends('Admin.layouts.master')
@section('content')
    @php
        $currentPage = 'faq';
    @endphp
 <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="row layout-top-spacing">
                <div class="top-tabel">
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="card-title">Manage Faq's</h6>
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
                                        <th class="text-center">Question</th>
                                        <th class="text-center">Answer</th>
                                        <th class="text-center">Active/Inactive</th>
                                        <th class="text-center">Created At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @php($count = 0)
                                    @foreach ($faqs as $faq)
                                        @php($count++)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input restaurant-checkbox" type="checkbox"
                                                        name="user_ids[]" value="{{ $faq->id }}" />

                                                </div>
                                            </td>
                                            <td class="text-center">{{ $count }}</td>
                                            <td class="text-center">{{ strip_tags($faq->question) }}</td>
                                            <td class="text-center">{{ strip_tags($faq->answer) }}</td>
                                            <td class="text-center">{{ $faq->is_active ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($faq->created_at)->format('m/d/Y H:i') }}
                                            </td>
                                            <td class="actions text-center">
                                                <a href="{{ url('/view_user/' . $faq->id) }}">
                                                    <img src="{{ asset('public/assets/img/view.svg') }}" alt="View"
                                                        title="View" style="width: 20px;" />
                                                </a>
                                                <a href="{{ url('/edit_user/' . $faq->id) }}">
                                                    <img src="{{ asset('public/assets/img/edit.svg') }}" alt="Edit"
                                                        title="Edit" style="width: 20px;" />
                                                </a>
                                                <a href="#" class="delete-customer-user"
                                                    data-id="{{ $faq->id }}" alt="Delete" title="Delete"
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
@endsection
@section('section_script')
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


            $(document).ready(function() {
                $('<button><a class="extra-btn width-max-content" href="{{ route('faq.create') }}">Add</a></button>')
                    .insertBefore("#zero-config_filter label");
            });
 
        });

    </script>
@endsection

