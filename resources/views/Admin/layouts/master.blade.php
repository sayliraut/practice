@include('Admin.header')
<div class="header-container container-xxl">
    <header class="header navbar navbar-expand-sm expand-header">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown user">
                        <a class="nav-link dropdown-toggle" href="{{ route('profile') }}">
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
        <img src="{{ asset('public/assets/img/logo.png') }}" class="logo" alt="">
        <h3 class="hide">Practice</h3>
    </div>
    <div class="sidebar-links">
        <ul>
            <div class="active-tab"></div>

            @if (Auth::guard('admin')->user()->getPermissionGranted(Auth::guard('admin')->user()->id, 'dashboard'))
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
            @endif

        </ul>
    </div>
    <div class="sidebar-links">
        <ul>
            <div class="active-tab"></div>
            @if (Auth::guard('admin')->user()->principal_type_xid != 2)
                <li class="tooltip-element <?php
                if ($currentPage == 'sub-admins') {
                    echo 'active';
                }
                ?>" data-tooltip="0">
                    <a href="{{ route('manage.subAdmin') }}" data-active="0">
                        <div class="icons">
                            <img src="{{ asset('public/assets/img/Group 57904.svg') }}" />
                            <span class="text">Sub Admins</span>
                        </div>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <div class="sidebar-links">
        <ul>
            <div class="active-tab"></div>
            @if (Auth::guard('admin')->user()->principal_type_xid != 1)
                <li class="tooltip-element <?php
                if ($currentPage == 'contact-admin') {
                    echo 'active';
                }
                ?>" data-tooltip="0">
                    <a href="{{ route('subadmin.contact.admin') }}" data-active="0">
                        <div class="icons">
                            <img src="{{ asset('public/assets/img/Group 57904.svg') }}" />
                            <span class="text">Contact Admin</span>
                        </div>
                    </a>
                </li>
            @endif
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
            $('#usersDropdownContent').toggle();
            $('#arrowIcon').toggleClass('fa-angle-down fa-angle-up');
        });
    });
</script>
