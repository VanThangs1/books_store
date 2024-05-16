@extends('layouts.auth-layout')

@php
    $page_title = "Đăng Ký";
@endphp

@section('main')
<div class="p-3">
    <h4 class="font-18 m-b-5 text-center">Free Register</h4>
    <p class="text-muted text-center">Get your free Admiria account now.</p>

    <form class="form-horizontal m-t-30" action="{{route('admin.handleRegister')}}" method = "POST">
        <div class="form-group">
            <label for="username">Full Name</label>
            <input type="text" class="form-control" name = "name"  id="fullname" placeholder="Enter Full Name" required>
        </div>

        <div class="form-group">
            <label for="useremail">Email</label>
            <input type="email" class="form-control" name = "email" id="useremail" placeholder="Enter email" parsley-type="email" required>
        </div>


        <div class="form-group">
            <label for="userpassword">Password</label>
            <input type="password" class="form-control" name = "password" id="userpassword" placeholder="Enter password" required>
        </div>

        <div class="form-group">
            <label for="userpassword">Password Confirmation</label>
            <input type="password" class="form-control" data-parsley-equalto="#userpassword" id="password_comfirmation" required placeholder="Enter password">
        </div>

        <div class="form-group row m-t-20">
            <div class="col-12 text-right">
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
            </div>
        </div>

        <div class="form-group m-t-10 mb-0 row">
            <div class="col-12 m-t-20">
                <p class="font-14 text-muted mb-0">By registering you agree to the Admiria <a href="#">Terms of Use</a></p>
            </div>
        </div>
        @csrf
    </form>
</div>
@endsection


@section('footer')
<div class="m-t-40 text-center">
    <p class="">Already have an account ? <a href="{{route('admin.login')}}" class="font-500 font-14 font-secondary"> Login </a> </p>
    <p class="">© 2017 - 2019 Admiria. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
</div>
@endsection

@section('scripts')
  
@endsection