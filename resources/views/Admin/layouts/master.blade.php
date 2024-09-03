@include('Admin.header')
<div class="header-container container-xxl">
    <header class="header navbar navbar-expand-sm expand-header">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item dropdown notification">
                        <a class="nav-link dropdown-toggle " href="#" id="userProfileDropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('public/assets/img/bell.svg') }}" />
                            <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown"
                                data-bs-popper="none">
                                <div class="dropdown-item">
                                    <div class="notify-content">
                                        <div class="msg-title">
                                            <h3>Notifications</h3>
                                            <a href="#">Viewall</a>
                                        </div>
                                        <div class="divider"></div>
                                        <h4>Lorem ipsum</h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </p>
                                        <span class="tms">9 min ago</span>
                                        <div class="divider"></div>
                                        <h4>Lorem ipsum <span></span></h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </p>
                                        <span class="tms">9 min ago</span>

                                    </div>

                                </div>
                            </div>
                    </li>
                    <li class="nav-item dropdown user">
                        <!-- <a class="nav-link dropdown-toggle" href="">
                            <div class="avatar-container">
                                <div class="avatar avatar-sm avatar-indicators avatar-online">
                                    <img alt="avatar" src="{{ asset('public/assets/img/profile-30.png') }}" class="rounded-circle">
                                </div>
                            </div>
                        </a> -->
                        <a class="nav-link dropdown-toggle" href="{{route('profile')}}">
                            <div class="avatar-container">
                                <div class="avatar avatar-sm avatar-indicators avatar-online">
                                    @php
                                        $profilePhoto = Auth::guard('admin')->user()->profile_photo;
                                        $userPhoto = 'user.png';
                                    @endphp
                                    <img alt="avatar"
                                        src="{{ asset('storage/app/public/uploads/admin_images/' . ($profilePhoto ?: $userPhoto)) }}"
                                        class="rounded-circle">
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown"
                            data-bs-popper="none">
                            <div class="dropdown-item">
                                <a href="signup.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg> <span>Log Out</span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</div>
<!-- sidebar -->
<nav>
    <div class="sidebar-top">
        <span class="shrink-btn">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </span>
        <img src="{{ asset('public/assets/img/seasons_logo.png') }}" class="logo" alt="">
        <h3 class="hide">Seasons</h3>
    </div>
    <div class="sidebar-links" style="overflow: scroll;">
        <ul>
            <div class="active-tab"></div>

            <li class="tooltip-element <?php
            if ($currentPage == 'dashboard') {
                echo 'active';
            }
            ?>" data-tooltip="0">
                <a href="{{ route('index') }}" data-active="0">
                    <div class="icons">
                        <img src="{{ asset('public/assets/img/dashboard.svg') }}" />
                        <span class="text">Dashboard</span>
                    </div>
                </a>
            </li>
            {{-- @if (Auth::guard('admin')->user()->getPermissionGranted(Auth::guard('admin')->user()->id, 'manage-users')) --}}
                {{-- <button class="dropdown-btn-users mb-1 active">
                    <div class="icons d-flex align-items-center justify-content-start w-100">
                        <img src="{{ asset('public/assets/img/Group 57904.svg') }}" />
                        <span class="text-1">Manage Users</span>
                    </div>
                    <i class="fa fa-angle-down mr-3" aria-hidden="true"></i>
                </button> --}}

                {{-- <div class="dropdown-container"
                    style="{{ $currentPage == 'manage-customer' || $currentPage == 'manage-restaurant_app' || $currentPage == 'sub-admins' ? 'display: block;' : 'display: none;' }}">
                    <ul class="random_cl">
                        <li class="tooltip-element {{ $currentPage == 'manage-customer' ? 'active' : '' }}"
                            data-tooltip="1">
                            <a href="{{ route('manage.customer') }}" data-active="1" class="text">Customer App

                            </a>
                        </li>

                        <li class="tooltip-element {{ $currentPage == 'manage-restaurant_app' ? 'active' : '' }}"
                            data-tooltip="1">
                            <a href="{{ route('restraunt_users') }}" data-active="1" class="text">Restaurant App
                            </a>
                        </li>

                        <li class="tooltip-element {{ $currentPage == 'sub-admins' ? 'active' : '' }}"
                            data-tooltip="1">
                            <a href="{{ route('manage.subAdmin') }}" data-active="1" class="text">Sub Admins
                            </a>
                        </li>
                    </ul>
                </div> --}}
            {{-- @endif --}}


            {{-- <li class="tooltip-element <?php
            if ($currentPage == 'manage-passports') {
                echo 'active';
            }
            ?>" data-tooltip="2">
                <a href="{{ route('manage.passport') }}" data-active="2">
                    <div class="icons">
                        <img src="{{ asset('public/assets/img/Group.svg') }}" >
                        <span class="text">Manage Passports</span>
                    </div>
                </a>
            </li> --}}
            {{-- @if (Auth::guard('admin')->user()->getPermissionGranted(Auth::guard('admin')->user()->id, 'manage-restaurant')) --}}
                <li class="tooltip-element <?php
                if ($currentPage == 'manage-restaurant') {
                    echo 'active';
                }
                ?>" data-tooltip="3">
                    {{-- <a href="{{ route('manage.restaurants') }}" data-active="3">
                        <div class="icons">
                            <img src="{{ asset('public/assets/img/coupon 1.svg') }}" />
                            <span class="text">Manage Restaurant</span>
                        </div>
                    </a> --}}
                </li>

            {{-- @endif --}}
            {{-- @if (Auth::guard('admin')->user()->getPermissionGranted(Auth::guard('admin')->user()->id, 'manage-contact-us')) --}}
                {{-- <li class="tooltip-element <?php
                if ($currentPage == 'manage-contact-us') {
                    echo 'active';
                }
                ?>" data-tooltip="4">
                    <a href="{{ route('manage.contact') }}" data-active="4">
                        <div class="icons">
                            <img src="{{ asset('public/assets/img/call(1) 3.svg') }}" />
                            <span class="text">Manage Contact Us</span>
                        </div>
                    </a>
                </li> --}}
            {{-- @endif --}}

            {{-- @if (Auth::guard('admin')->user()->getPermissionGranted(Auth::guard('admin')->user()->id, 'manage-state')) --}}
                {{-- <li class="tooltip-element <?php
                if ($currentPage == 'manage-location') {
                    echo 'active';
                }
                ?>" data-tooltip="4">
                    <a href="{{ route('manage_location') }}" data-active="4">
                        <div class="icons">
                            <img src="{{ asset('public/assets/img/location.png') }}" />
                            <span class="text">Manage States</span>
                        </div>
                    </a>
                </li> --}}
            {{-- @endif --}}
            {{-- @if (Auth::guard('admin')->user()->getPermissionGranted(Auth::guard('admin')->user()->id, 'manage-referral-codes')) --}}
                {{-- <li class="tooltip-element <?php
                if ($currentPage == 'manage-referral-codes') {
                    echo 'active';
                }
                ?>" data-tooltip="9">
                    <a href="{{ route('manage-referral-codes') }}" data-active="3">
                        <div class="icons">
                            <img src="{{ asset('public/assets/img/coupon 1.svg') }}" />
                            <span class="text">Referral Codes</span>
                        </div>
                    </a>
                </li> --}}

            {{-- @endif --}}



            <!-- <button class="dropdown-btn-users mb-1">
                <div class="icons d-flex align-items-center justify-content-start w-100">
                    <img src="{{ asset('public/assets/img/article-line.svg') }}" >
                    <span class="text-1">Manage CMS</span>
                </div>
                <i class="fa fa-angle-down mr-3" aria-hidden="true"></i>
            </button>

            <div class="dropdown-container">
                <ul>
                    <li class="tooltip-element <?php
                    if ($currentPage == 'manage-news') {
                        echo 'active';
                    }
                    ?>" data-tooltip="1">
                        <a href="" data-active="1">
                            <div class="icons">
                                <img src="{{ asset('public/assets/img/article 1.svg') }}" />
                                <span class="text">News & Article</span>
                            </div>
                        </a>
                    </li>

                    <li class="tooltip-element <?php
                    if ($currentPage == 'manage-newsletter') {
                        echo 'active';
                    }
                    ?>" data-tooltip="1">
                        <a href="" data-active="1">
                            <div class="icons">
                                <img src="{{ asset('public/assets/img/quill_inbox-newsletter.svg') }}" />
                                <span class="text">Newsletter</span>
                            </div>
                        </a>
                    </li>

                    <li class="tooltip-element <?php
                    if ($currentPage == 'manage-aboutus') {
                        echo 'active';
                    }
                    ?>" data-tooltip="1">
                        <a href="" data-active="1">
                            <div class="icons">
                                <img src="{{ asset('public/assets/img/user (2) 1.svg') }}" />
                                <span class="text">About Us</span>
                            </div>
                        </a>
                    </li>

                    <li class="tooltip-element <?php
                    if ($currentPage == 'manage-terms') {
                        echo 'active';
                    }
                    ?>" data-tooltip="1">
                        <a href="" data-active="1">
                            <div class="icons">
                                <img src="{{ asset('public/assets/img/contract 1.svg') }}" />
                                <span class="text">Terms & Conditions</span>
                            </div>
                        </a>
                    </li>

                    <li class="tooltip-element <?php
                    if ($currentPage == 'manage-faq') {
                        echo 'active';
                    }
                    ?>" data-tooltip="1">
                        <a href="" data-active="1">
                            <div class="icons">
                                <img src="{{ asset('public/assets/img/conversation 3.svg') }}" />
                                <span class="text">FAQ</span>
                            </div>
                        </a>
                    </li>

                    <li class="tooltip-element <?php
                    if ($currentPage == 'manage-privacy') {
                        echo 'active';
                    }
                    ?>" data-tooltip="1">
                        <a href="" data-active="1">
                            <div class="icons">
                                <img src="{{ asset('public/assets/img/privacy.svg') }}" />
                                <span class="text">Privacy Policy</span>
                            </div>
                        </a>
                    </li>


                </ul>
            </div> -->
            {{-- @if (Auth::guard('admin')->user()->getPermissionGranted(Auth::guard('admin')->user()->id, 'manage-cms')) --}}
                {{-- <li class="tooltip-element <?php
                if ($currentPage == 'manage-cms') {
                    echo 'active';
                }
                ?>" data-tooltip="7">
                    <a href="{{ route('manage.cms') }}" data-active="7">
                        <div class="icons">
                            <img src="{{ asset('public/assets/img/article-line.svg') }}" />
                            <span class="text">Manage CMS</span>
                        </div>
                    </a>
                </li> --}}
            {{-- @endif --}}
            {{-- @if (Auth::guard('admin')->user()->getPermissionGranted(Auth::guard('admin')->user()->id, 'manage-reports-analysis')) --}}
                {{-- <li class="tooltip-element <?php
                if ($currentPage == 'manage-reports') {
                    echo 'active';
                }
                ?>" data-tooltip="5">
                    <a href="{{ route('manage.reports') }}" data-active="5">
                        <div class="icons">
                            <img src="{{ asset('public/assets/img/admin 2.svg') }}" />
                            <span class="text">Manage Reports</span>
                        </div>
                    </a>
                </li> --}}
            {{-- @endif --}}

            {{-- @if (Auth::guard('admin')->user()->getPermissionGranted(Auth::guard('admin')->user()->id, 'manage-feedback')) --}}
                {{-- <li class="tooltip-element <?php
                if ($currentPage == 'manage-feedback') {
                    echo 'active';
                }
                ?>" data-tooltip="6">
                    <a href="{{ route('manage.feedback') }}" data-active="6">
                        <div class="icons">
                            <img src="{{ asset('public/assets/img/Group 51242.svg') }}" />
                            <span class="text">Manage Feedback</span>
                        </div>
                    </a>
                </li> --}}
            {{-- @endif --}}

             {{-- @if (Auth::guard('admin')->user()->getPermissionGranted(Auth::guard('admin')->user()->id, 'manage-rules'))
                <li class="tooltip-element <?php
                if ($currentPage == 'manage-rules') {
                    echo 'active';
                }
                ?>" data-tooltip="6">
                    <a href="" data-active="6">
                        <div class="icons">
                            <img src="{{ asset('public/assets/img/Group.svg') }}" />
                            <span class="text">Manage  Rules </span>
                        </div>
                    </a>
                </li>
            @endif  --}}




            {{-- @if (Auth::guard('admin')->user()->getPermissionGranted(Auth::guard('admin')->user()->id, 'manage-rules')) --}}
                {{-- <button class="dropdown-btn-users mb-1 active">
                    <div class="icons d-flex align-items-center justify-content-start w-100">
                        <img src="{{ asset('public/assets/img/Group 57904.svg') }}" />
                        <span class="text-1">Manage Rules</span>
                    </div>
                    <i class="fa fa-angle-down mr-3" aria-hidden="true"></i>
                </button>

                <div class="dropdown-container"
                    style="{{ $currentPage == 'manage-rules' || $currentPage == 'manage-referral-rule'  ? 'display: block;' : 'display: none;' }}">
                    <ul class="random_cl">
                        <li class="tooltip-element {{ $currentPage == 'manage-rules' ? 'active' : '' }}"
                            data-tooltip="1">
                            <a href="{{ route('manage_rules') }}" data-active="1" class="text">Redemption Rules

                            </a>
                        </li>

                        <li class="tooltip-element {{ $currentPage == 'manage-referral-rule' ? 'active' : '' }}"
                            data-tooltip="1">
                            <a href="{{ route('manage_referral') }}" data-active="1" class="text">Referral Rules
                            </a>
                        </li>

                        
                    </ul>
                </div> --}}
            {{-- @endif --}}
           
            {{-- @if (Auth::guard('admin')->user()->getPermissionGranted(Auth::guard('admin')->user()->id, 'manage-notification')) --}}
                {{-- <li class="tooltip-element <?php
                if ($currentPage == 'manage-notification') {
                    echo 'active';
                }
                ?>" data-tooltip="6">
                    <a href="{{ route('manage.notification') }}" data-active="6">
                        <div class="icons">
                            <img src="{{ asset('public/assets/img/Vector_31.svg') }}" />
                            <span class="text">Manage Notification</span>
                        </div>
                    </a>
                </li> --}}
            {{-- @endif --}}


            <!-- <li class="tooltip-element <?php
            if ($currentPage == 'manage-subscription') {
                echo 'active';
            }
            ?>" data-tooltip="3">
                <a href="manage-subscription.php" data-active="3">
                    <div class="icons">
                        <img src="../src/assets/img/newspaper-fee-svgrepo-com.svg" />
                        <span class="text">Subscription</span>
                    </div>
                </a>
            </li> -->
            <!-- <li class="tooltip-element <?php
            if ($currentPage == 'manage-transcation') {
                echo 'active';
            }
            ?>" data-tooltip="3">
                <a href="manage-transcation.php" data-active="3">
                    <div class="icons">
                        <img src="../src/assets/img/transaction.svg" />
                        <span class="text">Manage Transaction</span>
                    </div>
                </a>
            </li>-->


            <!-- <li class="tooltip-element <?php
            if ($currentPage == 'manage-contact') {
                echo 'active';
            }
            ?>">
                <a href="manage-contact.php" aria-expanded="false" class="dropdown-toggle">
                    <div class="icons">
                        <img src="../src/assets/img/customer-list-line-svgrepo-com.svg" />
                        <span class="text">Manage Contact Us</span>
                    </div>
                </a>
            </li> -->
            <!-- <li class="tooltip-element <?php
            if ($currentPage == 'manage-role') {
                echo 'active';
            }
            ?>" data-tooltip="3">
                <a href="manage-role.php" data-active="3">
                    <div class="icons">
                        <img src="../src/assets/img/users-svgrepo-com.svg" />
                        <span class="text">Manage Roles</span>
                    </div>
                </a>
            </li> -->


        </ul>
    </div>

</nav>
<!-- BEGIN LOADER -->
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>

<div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>
    <div id="content" class="main-content">
        @yield('content')
    </div>
</div>

@include('Admin.footer')
<script>
    $(document).ready(function() {
        $('#manageUsersButton').click(function() {
            $('#usersDropdownContent').toggle(); // Toggle dropdown content visibility
            $('#arrowIcon').toggleClass('fa-angle-down fa-angle-up'); // Toggle arrow icon class
        });
    });
</script>
