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
                                            <td class="text-center">{{ $faq->question }}</td>
                                            <td class="text-center">{{ $faq->answer }}</td>
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