
@extends('Admin.layouts.master')
@section('content')
<?php $currentPage = 'contact-admin'; ?>

    <style>
        .error-message {
            color: #FF0000;
        }

        form .error-message {
            color: red;
            / Set your desired color here /
        }
    </style>
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing chatbox">
                    <div class="widget-content widget-content-area br-8 position-btn">
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="card-title">Contact Admin</h6>
                        </div>

                        <div class="chat_box">
                            <div class="head">
                                <div class="user d-flex align-items-center">
                                    <img src="{{ asset('public/admin-dashboard/assets/css/src/assets/images/user.png') }}"
                                        alt="Admin Image" style="height: 50px; margin-right: 10px;">
                                    @php
                                        $adminUser = Auth::guard('admin')->user();
                                        $profilePhoto = $adminUser->profile_photo;
                                        $userPhoto = 'user.png';
                                    @endphp<div class="chat-name">
                                        <span>{{ $adminUser->first_name }} {{ $adminUser->last_name }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="chat-body">
                                @foreach ($messages as $chatmessage)
                                    @if ($adminUser->id == $chatmessage->sender_id && !empty($chatmessage->message))
                                        <div class="incoming pt-3">
                                            <div class="bubble mb-n3">
                                                <p>{{ $chatmessage->message }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="outgoing pt-3">
                                            <div class="bubble mb-n3">
                                                <p>{{ $chatmessage->message }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="chat-footer">
                                <div class="chat-input">
                                    <form id="submit_subadmin_response" method="POST" enctype="multipart/form-data"
                                        class="d-flex align-items-center">
                                        @csrf
                                        <input type="hidden" name="receiver_id" value="1">

                                        <input type="text" name="message"
                                            class="input-box form-control me-2" placeholder="Message" style="flex: 1;" />

                                        <button type="submit" id="submit_admin_resp_btn"
                                            style="background: none; border: none; padding: 0; cursor: pointer;">
                                            <svg width="28" height="28" viewBox="0 0 66 73" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M63.4845 36.397L29.1065 36.2614" stroke="#9A0000"
                                                    stroke-width="3.55946" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M63.4833 36.4029L21.362 59.5187L29.1053 36.2674L21.2222 12.9544L63.4833 36.4029Z"
                                                    stroke="#9A0000" stroke-width="3.55946" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                            </div>

                        </div> <!-- chat_box -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('section_script')
    <script>
        $(document).ready(function() {
            $('#submit_subadmin_response').validate({
                rules: {
                    message: {
                        required: true
                    }
                },
                messages: {
                    message: {
                        required: "Please enter a message"
                    }
                },
                errorClass: 'error-message',
                submitHandler: function(form) {
                    let formData = new FormData(form);

                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        type: "POST",
                        url: "{{ route('submit-subadmin-contact-admin') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.status_code === 200) {
                                toastr.success('Response sent successfully');
                                setTimeout(() => location.reload(), 2000);
                            } else {
                                toastr.error(response.message || 'Something went wrong');
                                setTimeout(() => location.reload(), 2000);
                            }
                        },
                        error: function(xhr) {
                            toastr.error('An error occurred');
                            console.error(xhr);
                        }
                    });
                }
            });

            $('#submit_admin_resp_btn').on('click', function(e) {

                // Trigger jQuery validate manually
                $('#submit_subadmin_response').valid(); // This will trigger the validation
            });

        });
    </script>
@endsection
