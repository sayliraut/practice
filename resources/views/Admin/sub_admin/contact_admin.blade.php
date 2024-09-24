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
                    <img src="{{asset('public/admin-dashboard/assets/css/src/assets/images/arrow-left.svg')}}" alt="">
                </a>
                Contact Admin
            </h6>
        </div>
    </div>
    <div class="chat-section layout-top-spacing mt-4">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="chat-system" style="width: 80%;margin: 0 auto;">
                    <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg></div>
                    <div class="chat-box" style="height: calc(-158px + 108vh);">
                        <div class="chat-not-selected" style="display: none;">
                            <p> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg> Click User To Chat</p>
                        </div>
                        @php
                        $adminUser = Auth::guard('admin')->user();
                        $profilePhoto = $adminUser->profile_photo;
                        $userPhoto = 'user.png';
                        @endphp

                        <div class="chat-box-inner" style="height: 100%;">
                            <div class="chat-meta-user chat-active">

                                <div class="current-chat-user-name">
                                    <span><img src="{{asset('public/admin-dashboard/assets/css/src/assets/images/user.png')}}" alt="dynamic-image">
                                        <span class="name">{{$adminUser->first_name}}</span></span></div>
                            </div>
                            <div class="chat-conversation-box ps ps--active-y">
                                <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">

                                    <div class="chat active-chat" data-chat="person1">
                                        <div class="conversation-start">
                                            <span>{{ now()->format('l, F j, Y H:i A') }}</span>
                                        </div>
                                        @foreach ($messages as $message)
                                        @if ($message->is_admin_response == 1 && !empty($message->contact_admin_response))
                                        <div class="bubble you">
                                            {{ $message->contact_admin_response }}
                                        </div>
                                        @elseif ($message->is_subadmin_response == 0 && !empty($message->subadmin_response))
                                        <div class="bubble me">
                                            {{ $message->subadmin_response }}
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                </div>
                                <div class="ps__rail-y" style="top: 0px; right: 0px; height: 43px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 8px;"></div>
                                </div>
                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                </div>
                                <div class="ps__rail-y" style="top: 0px; right: 0px; height: 43px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 8px;"></div>
                                </div>
                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                </div>
                                <div class="ps__rail-y" style="top: 0px; right: 0px; height: 43px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 8px;"></div>
                                </div>
                            </div>
                            <div class="chat-footer chat-active">
                                <div class="chat-input">
                                    <form id="submit_contact_admin_response" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="sender_id" value="{{ $admin_user->id }}">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square" style="color: #9A0000; cursor: pointer;">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        <input type="text" class="mail-write-box form-control" placeholder="Message" name="affiliate_response" id="affiliate_response">
                                        <div class="send">
                                            <svg width="28" height="28" viewBox="0 0 66 73" fill="none" xmlns="http://www.w3.org/2000/svg" id="submit_admin_resp_btn" style="cursor: pointer;">
                                                <path d="M63.4845 36.397L29.1065 36.2614" stroke="#9A0000" stroke-width="3.55946" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M63.4833 36.4029L21.362 59.5187L29.1053 36.2674L21.2222 12.9544L63.4833 36.4029Z" stroke="#9A0000" stroke-width="3.55946" stroke-linecap="round" stroke-linejoin="round" />
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
@endsection



@section('scripts')
<script>
    $('#user-listtab').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>"
        , "oLanguage": {
            "oPaginate": {
                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>'
                , "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            }
            , "sInfo": "Showing page _PAGE_ of _PAGES_"
            , "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>'
            , "sSearchPlaceholder": "Search..."
            , "sLengthMenu": "Results :  _MENU_"
        , }
        , "stripeClasses": []
        , "lengthMenu": [7, 10, 20, 50]
        , "pageLength": 10
    });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $("#submit_admin_resp_btn").click(function(event) {

            event.preventDefault(); // Prevent default form submission

            // Submit the form
            $('#submit_contact_admin_response').submit();
        });

        $.validator.addMethod("lettersOnly", function(value, element) {
            return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
        }, "Please enter only alphabets");

        $.validator.addMethod("numbersOnly", function(value, element) {
            return this.optional(element) || /^[0-9]+$/.test(value);
        }, "Please enter only numbers");


        $('#submit_contact_admin_response').validate({
            rules: {
                affiliate_response: {
                    required: true,

                },

            }
            , messages: {
                affiliate_response: {
                    required: "Please Enter Some Text"
                , },

            }

            , errorClass: 'error-message'
            , submitHandler: function(form) {
                let base_url = url_path;
                var formData = new FormData(form);
                console.log('hii', formData);
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    , }
                    , type: "post"
                    , url: "{{ route('submit-subadmin-contact-admin') }}"
                    , data: formData
                    , contentType: false
                    , processData: false
                    , success: function(result) {
                        if (result.status_code == 200) {
                            toastr.success('Response Sent Sucessfully');
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
                    }
                , });
            }
        });

    });

</script>
@endsection
