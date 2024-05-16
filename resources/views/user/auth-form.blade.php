@extends('layouts.user-onlyheader-layout')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/user-page/auth.css')}}">
    <style>
        button {
            cursor: pointer;
            background: #FFB7B7;
        }

        button:hover {
            opacity: 0.8;
        }
    </style>
@endsection

@section('main')
    <div class="auth-form">
        <div class="container">
            <div class="control">
                <p class = "active" onclick = "setFlagmentIndentifier('login')">Đăng Nhập</p>
                <p onclick = "setFlagmentIndentifier('register')">Đăng Ký</p>
                <p onclick = "setFlagmentIndentifier('forgot-password')">Quên mật khẩu?</p>
            </div>
            <div class="form">
                <form action="{{route('handle-login')}}" method="POST" class="active-form login">
                    <div class="contain">
                        <div class="input">
                            <label for="">
                                Email
                            </label>
                            <input type="text" value = "{{old('email') ?? ''}}" name = "email" placeholder = "Nhập địa chỉ email...">
                        </div>
                        <div class="input">
                            <label for="">
                                Mật khẩu
                            </label>
                            <input type="text" name = "password" placeholder = "Nhập mật khẩu...">
                        </div>
                        <button>Đăng nhập</button>
                    </div>
                    @method('POST')
                    @csrf
                </form>
                <form action="{{route('handle-register')}}" method="POST" class="register">
                    <div class="contain">
                        <div class="input">
                            <label for="">
                                Họ, tên
                            </label>
                            <input type="text" value = "{{old('name') ?? ''}}" name = "name" placeholder = "Nhập họ, tên...">
                        </div>
                        <div class="input">
                            <label for="">
                                Email
                            </label>
                            <input type="text" value = "{{old('email') ?? ''}}" name = "email" placeholder = "Nhập địa chỉ email...">
                        </div>
                        <div class="input">
                            <label for="">
                                Mật khẩu
                            </label>
                            <input type="password" value = "{{old('password') ?? ''}}" name = "password" placeholder = "Nhập mật khẩu...">
                        </div>
                        <div class="input">
                            <label for="">
                                Xác nhận mật khẩu
                            </label>
                            <input type="password" name = "password_confirmation" placeholder = "Nhập lại mật khẩu...">
                        </div>
                        <button>Đăng ký</button>
                    </div>
                    @method('POST')
                    @csrf
                </form>
                <form action="{{route('handle-forget')}}" method = "POST" class = "register">
                    <div class="contain">
                        <div class="input">
                            <label for="">
                                Email
                            </label>
                            <input type="text" value = "{{old('email') ?? ''}}" name = "email" placeholder = "Nhập địa chỉ email...">
                        </div>
                        <button>Lấy lại mật khẩu</button>
                    </div>
                    @method('POST')
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/user-auth.js')}}"></script>
@endsection