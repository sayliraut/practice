<?php $currentPage = 'contact-admin'; ?>

@extends('Admin.layouts.master')
@section('content')
    <style>
        .error-message {
            color: #FF0000;
        }

        form .error-message {
            color: red;
            / Set your desired color here /
        }
    </style>
    <div class="main-sec reff-view">
        <div class="row">
            <div class="col-md-4 left">
                <h6 class="card-title mt-4">
                    <a href="">
                        <img src="{{ asset('public/admin-dashboard/assets/css/src/assets/images/arrow-left.svg') }}"
                            alt="">
                    </a>
                    Contact Admin
                </h6>
            </div>
        </div>
        <div class="chat-section layout-top-spacing mt-4">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="chat-system" style="width: 80%;margin: 0 auto;">
                        <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-menu mail-menu d-lg-none">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg></div>
                        <div class="chat-box" style="height: calc(-158px + 108vh);">
                            <div class="chat-not-selected" style="display: none;">
                                <p> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-message-square">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                    </svg> Click User To Chat</p>
                            </div>
                            @php
                                $adminUser = Auth::guard('admin')->user();
                                $profilePhoto = $adminUser->profile_photo;
                                $userPhoto = 'user.png';
                            @endphp

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
                                            <!-- Outgoing message -->
                                            <div class="outgoing pt-3">
                                                <div class="bubble mb-n3">
                                                    <p>{{ $chatmessage->message }}</p>
                                                </div>
                                            </div>
                                        @elseif ($adminUser->id == $chatmessage->receiver_id && !empty($chatmessage->message))
                                            <!-- Incoming message -->
                                            <div class="incoming pt-3">
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

                                            <input type="text" name="message" class="input-box form-control me-2"
                                                placeholder="Message" style="flex: 1;" />

                                            <button type="submit" id="submit_admin_resp_btn"
                                                style="background: none; border: none; padding: 0; cursor: pointer;">
                                                <svg width="28" height="28" viewBox="0 0 66 73" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M63.4845 36.397L29.1065 36.2614" stroke="#9A0000"
                                                        stroke-width="3.55946" stroke-linecap="round"
                                                        stroke-linejoin="round" />
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
