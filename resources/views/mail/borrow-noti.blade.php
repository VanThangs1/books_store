<!DOCTYPE html>
<html>
<head>
    <title>Thông báo đơn mượn sách</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 600px;
            margin: 0 auto;
        }

        h2 {
            color: #333333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }

        .total {
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            color: #888888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thông báo đơn mượn sách</h2>
        <p>Dear <strong>{{auth() -> guard('web') -> user() -> name}}</strong>,</p>
        <p>Dưới đây là thông tin chi tiết về đơn mượn sách của bạn:</p>
        <table>
            <tr>
                <th>Tên sách</th>
                <th>Ngày mượn</th>
                <th>Ngày trả</th>
                <th>Giá mượn / ngày</th>
            </tr>
            <tr>
                <td>{{$title ?? ''}}</td>
                <td>{{$borrow_date}}</td>
                <td>{{$return_date}}</td>
                <td>{{number_format($price ?? 0)}}đ/ngày</td>
            </tr>
            <tr class="total">
                <td colspan="3">Tổng tiền</td>
                <td>{{number_format($total_days * $price ?? 0)}} đ</td>
            </tr>
        </table>
        <p>Cảm ơn bạn đã mượn sách. Vui lòng trả sách đúng hạn.</p>
        <div class="footer">
            <p>Trân trọng,</p>
            <p>The Books Store Team</p>
        </div>
    </div>
</body>
</html>