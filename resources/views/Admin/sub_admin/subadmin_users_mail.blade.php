<?php $currentPage = 'manage-users'; ?>
@extends('Admin.layouts.master')
{{-- @section('title', 'Sub-admin') --}}
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

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="search-overlay"></div>
            <div class="top-tabel">
                <div class="layout-px-spacing">
                    <div class="middle-content  p-0 container">
                        <div class="row layout-top-spacing ">
                            <div class="top-tabel">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing  chatbox">
                                <div class="widget-content widget-content-area br-8 position-btn">

                                    <div class="top-tabel">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h6 class="card-title">Manage Sub Admins</h6>
                                            </div>
                                            <div class="col-md-8">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat_box">
                                        <div class="head">
                                            <div class="user">
                                                <div class="avatar">
                                                </div>
                                                <!-- <div class="avatar avatar-sm avatar-indicators avatar-online">
                                                                                @php
                                                                                    $adminUser = Auth::guard(
                                                                                        'admin',
                                                                                    )->user();
                                                                                    $profilePhoto =
                                                                                        $adminUser->profile_photo;
                                                                                    $userPhoto = 'user.png';
                                                                                @endphp
                                                                                <img alt="avatar" src="{{ asset('storage/app/public/uploads/admin_images/' . ($profilePhoto ?: $userPhoto)) }}" class="rounded-circle"> --}}
                                                                            </div> -->
                                                <div class="chat-name">
                                                    <span><img
                                                            src="{{ asset('public/admin-dashboard/assets/css/src/assets/images/user.png') }}"
                                                            alt="dynamic-image"
                                                            style="height:50px;">{{ $adminUser->first_name }}
                                                        {{ $adminUser->last_name }}</span>
                                                </div>
                                                <!-- <div class="chat-name">
                                                                               <span>{{ $adminUser->first_name }} {{ $adminUser->last_name }}</span>
                                                                            </div> -->

                                            </div>
                                        </div>

                                        <div class="chat-body">
                                            @foreach ($messages as $message)
                                                @if ($message->is_affiliate_response == 0 && !empty($message->affiliate_response))
                                                    <div class="incoming" style="padding-top: 22px;">
                                                        <div class="bubble" style="margin-bottom: -11px;">
                                                            <p>{{ $message->affiliate_response }}</p>
                                                        </div>
                                                    </div>
                                                @elseif ($message->is_admin_response == 1 && !empty($message->contact_admin_response))
                                                    <div class="outgoing" style="padding-top: 22px;">
                                                        <div class="bubble" style="margin-bottom: -11px;">
                                                            <p>{{ $message->contact_admin_response }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="chat-footer">
                                            <div class="chat-input">
                                                <form id="submit_subadmin_response" 
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" name="receiver_id"
                                                        value="{{ $affiliate_user->id }}">
                                                    <input type="text" class="input-box" placeholder="Message"
                                                        name="contact_admin_response" id="contact_admin_response">
                                                    <div class="chat-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-message-square">
                                                            <path
                                                                d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="send">
                                                        <svg width="28" height="28" viewBox="0 0 66 73"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            id="submit_subadmin_resp_btn" style="cursor: pointer;">
                                                            <path d="M63.4845 36.397L29.1065 36.2614" stroke="#9A0000"
                                                                stroke-width="3.55946" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M63.4833 36.4029L21.362 59.5187L29.1053 36.2674L21.2222 12.9544L63.4833 36.4029Z"
                                                                stroke="#9A0000" stroke-width="3.55946"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src={{ asset('public/assets/js/apps/chat.js') }}></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
            integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {

                $("#contact_admin_response").keypress(function(event) {
                    if (event.keyCode === 13) {
                        event.preventDefault();
                        $('#submit_subadmin_response').submit();
                    }
                });

                $("#submit_subadmin_resp_btn").click(function(event) {
                    $('#submit_subadmin_response').submit();
                });

                $('#submit_subadmin_response').validate({
                    rules: {
                        contact_admin_response: {
                            required: true,
                        },
                    },
                    messages: {
                        contact_admin_response: {
                            required: "Please enter a message",
                        },
                    },
                    errorClass: 'error-message',
                    submitHandler: function(form) {
                        var formData = new FormData(form);
                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            type: "post",
                            url: "{{ route('submit-subadmin-users-mail') }}",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(result) {
                                if (result.status_code == 200) {
                                    toastr.success('Response Sent Successfully');
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 2000);
                                } else if (result.status_code == 500) {
                                    toastr.error(result.message);
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 2000);
                                } else {
                                    toastr.error('Something Went Wrong');
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 2000);
                                }
                            },
                        });
                    }
                });
            });
        </script>
    @endsection
