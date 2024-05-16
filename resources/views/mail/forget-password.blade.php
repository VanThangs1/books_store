<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verify Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            color: #333333;
            margin-top: 0;
        }

        p {
            margin: 10px 0;
        }

        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
        }

        .footer {
            margin-top: 30px;
            color: #888888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Reset Password</h2>
        <p>Dear <strong>{{$name}}</strong>,</p>
        <p>Bạn đã yêu cầu khôi phục mật khẩu cho tài khoản của mình. Dưới đây là thông tin khôi phục mật khẩu:</p>
        <p>Mật khẩu mới: {{$newpassword}}</p>
        <p>Vui lòng xác nhận <a href="{{$resetlink}}">tại đây</a> để sử dụng mật khẩu mới này để đăng nhập và sau đó thay đổi thành mật khẩu của bạn.</p>
        <p></p>
        <p>
            <a class="button" href="{{$resetlink}}" style = "color: #fff" >Xác nhận khôi phục</a>
        </p>
        <p>Nếu bạn không yêu cầu khôi phục mật khẩu, vui lòng bỏ qua email này hoặc liên hệ với chúng tôi.</p>
        <div class="footer">
            <p>Trân trọng,</p>
            <p>The Books Store Team</p>
        </div>
    </div>
</body>
</html>