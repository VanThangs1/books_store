@extends('layouts.auth-layout')

@php
    $page_title = "Đăng Nhập";
@endphp

@section('main')
<div class="p-3">
    <h4 class="font-18 m-b-5 text-center">Welcome Back !</h4>
    <p class="text-muted text-center">Sign in to continue to Admiria.</p>

    <form class="form-horizontal m-t-30" action="{{route('admin.handleLogin')}}" method = "POST">

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name = "email" id="email" placeholder="Enter Email" parsley-type="email" required>
        </div>

        <div class="form-group">
            <label for="userpassword">Password</label>
            <input type="password" class="form-control" name = "password" id="userpassword" placeholder="Enter password" required>
        </div>

        <div class="form-group row m-t-20">
            <div class="col-sm-6">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customControlInline" >
                    <label class="custom-control-label" for="customControlInline">Remember me</label>
                </div>
            </div>
            <div class="col-sm-6 text-right">
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
            </div>
        </div>

        <div class="form-group m-t-10 mb-0 row">
            <div class="col-12 m-t-20">
                <a href="pages-recoverpw-2.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
            </div>
        </div>
        @csrf
    </form>
</div>

@endsection

@section('footer')
<div class="m-t-40 text-center">
    <p class="">Don't have an account ? <a href="{{route('admin.register')}}" class="font-500 font-14 font-secondary"> Signup Now </a> </p>
    <p class="">© 2017 - 2019 Admiria. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
</div>
@endsection



