@extends('Admin.layouts.app_login')
@section('title', 'Practice - login')
@section('content')
    <div class="row w-100" style="height: 100vh;">
        <div class=" col-md-6 m-auto h-100 d-flex flex-column align-itms-center justify-content-center"
            style="background-color: #05244D;">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('public/assets/img/logo.png') }}" width="150" height="150" alt="">
            </div>
        </div>
        <div class=" col-md-6 h-100 d-flex justify-content-center align-items-center login-background-img"
            style="background-image: url('public/assets/img/login_screen_background.png');">
            <div class="row d-flex flex-column justify-content-center align-items-center m-auto"
                style="width: 60%; z-index: 999;">
                <h3 class="text-start font-weight-bold mb-3 text-white">WELCOME BACK</h3>
                <form id="admin_login_form">
                    @csrf
                    <div class="col-md-12">
                        <div class="mb-3 input-parent">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <input type="email" name="email" class="form-control" placeholder="Email address">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 input-parent">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password">
                            <i class="fa fa-eye-slash" aria-hidden="true" id="passwordToggle"></i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div>
                            <button type="submit" id="admin_login_btn" class="p-0 download-btn"
                                class="w-100">Login</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('public/assets/js/admin/auth/login.js') }}"></script>

@endsection

