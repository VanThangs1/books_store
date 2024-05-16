@extends('layouts.user-onlyheader-layout')

@section('style')
    <style>
        .profile {
            display: flex;
            justify-content: center;
            font-size: 1.6rem;
        }
   
        .profile .container {
            min-height: 100px;
            background-color: #fff;
            margin: 7px 0;
            border-radius: 5px;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 50px;
        }

        .profile img {
            height: 130px;
            width: 130px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 0 5px #ccc;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.6rem;
            height: 35px;
            width: 130px;
        }

        .control {
            display: flex;
            justify-content: right;
            cursor: pointer;
        }

        .info p {
            margin-bottom: 15px;
        }

        /* Input styles */
        .profile input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button:hover {
            background-color: #0056b3;
        }

        .email {
            position: relative;
        }

        .verify {
            position: absolute; 
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            text-decoration: none;
        }

        .not {
            background-color: green;
            opacity: 0.7;
            color: #fff;
            padding: 2px 7px;
            border-radius: 4px;
            font-size: 1.4rem;
        }
    </style>
@endsection

@section('main')
    <div class="profile">
        <form class="container">
            <div class="left">
                <div class="avatar">
                    <img id="previewImage" src="https://cdn.dribbble.com/users/17793/screenshots/16101765/media/beca221aaebf1d3ea7684ce067bc16e5.png" alt="">
                    <input id="imageInput" type="file" name="image" accept="image/*">
                </div>
                <div class="info">
                    <div class="name"><strong>Họ tên: </strong><input type="text" name="name" value="{{Auth::guard('web') -> user() -> name}}"></div>
                    <div class="gender"><strong>Giới tính: </strong>{{Auth::guard('web') -> user() -> gender}}</div>
                </div>
            </div>
            <div class="right">
                <div class="payment">
                    <div class="email">
                        @if(Auth::guard('web') -> user() -> email_verified_at != null)
                            <p class = "verify" style = "color: green; opacity: 0.7">Đã xác minh</p>
                        @else
                            <a class = "verify not" href="{{route('verify_request')}}">Xác minh</a>
                        @endif 
                        <strong>Email: </strong><input type="text" name="email" value = "{{Auth::guard('web') -> user() -> email}}"></div>
                    <div class="phone"><strong>Điện thoại: </strong><input type="text" name = "phone" value = "{{Auth::guard('web') -> user() -> phone}}"></div>
                    <div class="address"><strong>Địa chỉ: </strong><input type="text" name = "address" value = "{{Auth::guard('web') -> user() -> address}}"></div>
                </div>
            </div>
            <div></div>
            <div class="control">
                <button>Cập nhật</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
            };
            
            reader.readAsDataURL(file); // Convert the file to a data URL format
        }
    });
        // JavaScript for Client-side Validation (Example)
        document.querySelector('.container').addEventListener('submit', function(e) {
            const email = document.querySelector('input[name="email"]').value;
            const phone = document.querySelector('input[name="phone"]').value;
            
            if (!isValidEmail(email)) {
                e.preventDefault(); // Prevent form submission
                alert('Invalid email format!');
            }
            
            // You can add more validations as needed
        });

        // Simple email validation function (you can use a library like validator.js for more robust validation)
        function isValidEmail(email) {
            const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return regex.test(email);
        }
    </script>
@endsection
