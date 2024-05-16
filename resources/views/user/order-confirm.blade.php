@extends('layouts.user-onlyheader-layout')

@section('style')
    <style>
        .cart {
            display: flex;
            justify-content: center;
            font-size: 1.6rem;
        }

        .cart .title {
            margin-top: 5px;
            margin-bottom: 10px;
            font-size: 2rem;
            font-weight: 500;
        }

        .cart .container {
            margin: 7px 0;
        }

        .cart .container .cart-content {
           display: grid;
           grid-template-columns: 3fr 1fr;
           grid-gap: 10px;
        }

        .cart-content .right .total-price,
        .cart-content .left .cart-header {
            background-color: #fff;
            border-radius: 5px;
            padding: 13px 20px;
        }
        .cart-content .left .cart-body {
            background-color: #fff;
            border-radius: 5px;
            padding: 10px 0;
        }

        .cart-content .left .cart-header {
            margin-bottom: 10px;
            padding: 13px;
            display: flex;
            justify-content: space-between;
        }

        .cart-body .product-item {
            display: flex;
            padding: 7px 0;
        }

        .cart .info {
            flex:1;
            display: flex;
        }
        .cart .info img {
            height: 70px;

        }

        .cart .info .img {
            width: 170px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .cart .item-action {
            width: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .cart .item-action button {
            border: none;
            background-color: transparent;
            font-size: 2rem;
            color: red;
            cursor: pointer;
        }

        .cart .item-action button:hover {
            opacity: 0.8;
        }

        .cart .item-total {
            width: 180px;
            padding-left: 7px;
        }

        .cart-body .item-total {
            color: #146EBE;
            font-size: 1.7rem;
            font-weight: 500;
        }

        .cart .item-total,
        .cart .item-quantity {
            display: flex;
            align-items: center;
        }

        .cart .item-action button:focus,
        .cart-content .select input[type="checkbox"]:focus {
            outline: none;
        }


        .cart-content .select {
            width: 20px;
            
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-content .select input[type="checkbox"] {
            height: 1.6rem;
            width: 1.6rem;
        }

        .cart-content .select input[type="checkbox"]:checked {
            background: red;
        }

        .cart .item-quantity {
            width: 140px;
            padding-left: 7px;
        }

        .detail-info  {
            flex: 1;
            padding-top: 5px;
        }

        .detail-info .price {
            display: flex;
            align-items: flex-end;
            margin-top: 20px;
        }

        .detail-info .price .real-price {
            color: #000;
            font-size: 1.5rem;
            font-weight: 500;
            padding-right: 7px;
        }

        .detail-info .price .old-price {
            color: #8491A3;
            font-weight: 300;
            font-size: 1.3rem;
            text-decoration: line-through;
        }

        .product-item {
            padding: 13px 0;
            border-bottom: 1px solid #ccc;
        }

        .product-item:nth-last-child(1) {
            border: none;
            padding-bottom: 0;
        }

        .right .total-price {
            display: flex;
            flex-direction: column;
            
        }

        .right .total-price h3 {
            font-size: 1.8rem;
            padding-bottom: 5px;
            font-weight: 400;
            border-bottom: 1px solid #ccc;
            margin-bottom: 13px;
        }

        .right .total-price .pay-price {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .cart a {
            text-decoration: none;
            color: #000;
            font-size: 1.6rem;
            
        }

        .cart a:hover {
            color: #146EBE;
            text-decoration: underline;
        }

        .btn-pay {
            height: 40px;
            border: none;
            border-radius: 5px;
            background: #ddd;
            font-size: 1.6rem;
            color: #fff;
            cursor: pointer;
        }

        .btn-pay:focus {
            outline: none;
        }

        .right .total-price .pay-price .btn-active {
            background-color: var(--primary-color-1);
        }

        .pay-price p:nth-child(1) {
            font-weight: bold;
        }

        .pay-price p:nth-child(2) {
            color: #146EBE;
            font-size: 1.7rem;
            font-weight: 500;
        }

        .btn-pay-enabled {
            background: #146EBE;
        }

        .btn-pay {
            transition: all 0.2s ease-in-out;
        }

        .btn-pay:hover {
            opacity: 0.9;
        }

        input[type="number"] {
            width: 100px!important;
            height: 30px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            color: #333;
            font-size: 14px;
            text-align: left;
            cursor: pointer;
        }

        input[type="checkbox"] {
            cursor: pointer;
        }

        .warn {
            font-size: 1.4rem;
            opacity: 0.8;
            margin-bottom: 7px;
            margin-top: 13px;
        }

        .warn i {
            opacity: 0.6;
        }

        .payment-info {
            background-color: #fff;
            border-radius: 5px;
            padding: 13px 20px;
            margin-top: 7px;
        }

        .info-payment {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
            margin-top: 17px;
            margin-bottom: 13px;
        }

        .box {
            font-size: 1.7rem;
            display: flex;
            flex-direction: column;
        }

        .box input {
            padding: 0 7px;
            margin-top: 5px;
            height: 35px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .box input:focus {
            outline: 1px solid #333;
        }

        .box textarea {
            padding: 5px 7px;
            border-radius: 5px;
        }

        .box label {
            margin-top: 7px;
            margin-bottom: 5px;
        }

        .box textarea:focus {
            font-size: 1.6rem;
            outline: 1px solid #333;
        }

        .right .payment-info{
            margin-bottom: 10px;
            margin-top: 0;
        }

        .right .payment-info h4 {
            margin-bottom: 13px;
        }

        .right .payment-info > div {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .right .payment-info label {
            cursor: pointer;
        }

        .right .payment-info > div i {
            margin-right: 5px;
            margin-left: 10px;
            
        }
        
    </style>
@endsection

@section('main')
    <form class="cart" action = "{{route('submitOrder')}}" method = "POST">
        <div class="container">
            <h2 class="title">
                ĐƠN HÀNG
            </h2>
            <div class="cart-content">
                <div class="left">
                    <div class="cart-header">
                        <div class = "info" style = "margin-left: 7px">
                            <span style = "font-weight: 500">Thông tin đơn hàng ({{$count}} sản phẩm)</span>
                        </div>
                        <div class = "item-quantity">
                            <span>Số lượng</span>
                        </div>
                        <div class = "item-total">
                            <span>Thành tiền</span>
                        </div>
                    </div>
                    <div class="cart-body">
                        @php 
                            $total = 0;
                        @endphp 
                        @foreach($productsInCart as $product)
                            <div class="product-item" data-product-id = "{{$product -> id}}">
                                <div class="info">
                                    <div class="img"><img src="{{$product -> image}}" alt=""></div>
                                    <div class="detail-info">
                                        <div class="name"><a target = "_blank" href="{{route('product_detail', ['slug' => $product -> slug])}}">{{$product -> title}}</a></div>
                                        <div class="price">
                                            <p class="real-price">{{number_format($product -> price)}} ₫</p>
                                            <p class="old-price">{{number_format($product -> price)}} ₫</p>
                                        </div>
                                    </div>
                                </div>
                                <div class = "item-quantity">
                                    {{$product -> quantityInCart}}
                                </div>

                                <div class = "item-total">
                                    @php 
                                        $productTotal = $product -> price * $product -> quantityInCart;
                                        $total += $productTotal;
                                        $count++;
                                    @endphp
                                    {{number_format($productTotal)}} ₫
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="payment-info">
                        <h4>Thông tin giao hàng</h4>
                        <div class="info-payment">
                            <div class="box">
                                <label for="name">Họ, tên người nhận</label>
                                <input required id = "name" name = "name" value = "{{Auth::guard('web') -> user() -> name}}" type="text">
                            </div>
                            <div class="box">
                                <label for="shipping_address">Địa chỉ nhận hàng</label>
                                <input required type="text" id = "shipping_address" name = "shipping_address" value = "{{Auth::guard('web') -> user() -> address}}">
                            </div>
                            <div class="box">
                                <label for="phone_number">Điện thoại</label>
                                <input required  type="text" id = "phone_number" name = "phone_number" value = "{{Auth::guard('web') -> user() -> phone_number}}">
                            </div>
                            <div class="box">
                                <label for="email">Email</label>
                                <input required type="text" id = "email" name = "email" value = "{{Auth::guard('web') -> user() -> email}}">
                            </div>
                        </div>
                        <div class="box">
                            <label for="">Ghi chú</label>
                            <textarea name="note" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="payment-info">
                        <h4>Phương thức thanh toán</h4>
                        <div>
                            <input type="radio" checked value = "1" name="pay_method" id="payment_method1" />
                            <label for="payment_method1"><i class="fa-solid fa-money-bills"></i> Thanh toán khi nhận hàng</label>
                        </div>
                        <div>
                            <input type="radio" value = "2" name="pay_method" id="payment_method2" />
                            <label for="payment_method2"><i class="fa-solid fa-building-columns"></i> Thanh toán ngân hàng nội địa</label>
                        </div>
                    </div>
                    <div class="total-price">
                        <h3>Thành tiền</h3>
                        <div class="pay-price">
                            <p>Tổng Số Tiền</p>
                            <p>{{number_format($totalPrice)}} ₫</p>
                        </div>
                        @if(!Auth::guard('web') -> check())
                            <p class = "warn"><i class="fa-solid fa-circle-exclamation"></i> Vui lòng đăng nhập tài khoản trước khi thanh toán!</p>
                        @endif
                        <button class = "btn-pay btn-pay-enabled">
                            ĐẶT HÀNG
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @csrf
        @method('POST')
    </form>
@endsection

@section('scripts')
    <script>
        // Lắng nghe sự kiện thay đổi phương thức thanh toán
        const paymentMethodRadios = document.getElementsByName('pay_method');
        paymentMethodRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                handlePaymentMethodChange(radio.value);
            });
        });

        // Hàm xử lý khi có sự thay đổi phương thức thanh toán
        function handlePaymentMethodChange(selectedValue) {
            // Kiểm tra giá trị đã chọn
            if (selectedValue === '1') {
                document.querySelector('.btn-pay').innerText = 'ĐẶT HÀNG';
            } else if (selectedValue === '2') {
                // Mã JavaScript cho phương thức thanh toán ngân hàng nội địa
                document.querySelector('.btn-pay').innerText = 'THANH TOÁN';
            }
        }
    </script>
@endsection
