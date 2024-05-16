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
        <h2>Verify Email</h2>
        <p>Dear <strong>{{auth() -> guard('web') -> user() -> name}}</strong>,</p>
        <p>Thank you for registering with us. To complete your registration, please verify your email address by clicking the button below:</p>
        <p>
            <a class="button" href="{{$verifylink}}">Verify Email</a>
        </p>
        <p>If you did not create an account, you can safely ignore this email.</p>
        <div class="footer">
            <p>Best regards,</p>
            <p>The Books Store Team</p>
        </div>
    </div>
</body>
</html>