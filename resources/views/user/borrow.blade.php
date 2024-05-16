@extends('layouts.user-onlyheader-layout')

@section('style')
    <style>
        .borrow {
            display: flex;
            justify-content: center;
            font-size: 1.6rem;
        }

        .borrow .container {
            margin: 7px 0
        }

        .borrow form {
            display: grid;
            grid-template-columns: 3fr 1fr;
            grid-gap: 7px;
        }

        .borrow .title {
            margin-top: 5px;
            margin-bottom: 10px;
            font-size: 2rem;
            font-weight: 500;
        }

        .borrow .left {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 7px;
        }
        
        .borrow .left .product-info,
        .borrow .left .order-info,
        .borrow .right .total-price {
            background: #fff;
            border-radius: 5px;
            padding: 20px 13px;
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

        .btn-pay {
            height: 40px;
            border: none;
            border-radius: 5px;
            background: #ddd;
            font-size: 1.6rem;
            color: #fff;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
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

        .borrow .product-info {
            display: flex;

        }

        .borrow .product-info img {
            max-height: 200px;
        }

        .borrow .product-info .content {
            display: flex;
            flex-direction: column;
            padding-bottom: 20px;
        }

        .borrow .product-info .content h3{
            font-weight: 500;
            margin-bottom: 13px;
        }

        .borrow .product-info .content p {
            padding: 5px 0;
        }

        .borrow .product-info .content .price {
            font-weight: 500;
            margin-top: 13px;
            font-size: 1.8rem;
            color: #146EBE;
        }

        .product-info .img {
            height: 250px;
            display: flex;
            justify-content: center;
            width: 250px;
        }

        .right .info-pay div{
            display: flex;
            justify-content: space-between;
        }
        .right .info-pay div p {
            padding: 2px 0;
        }

        .right .info-pay {
            border-bottom: 1px solid #ccc;
            margin-bottom: 7px;
            padding-bottom: 7px;
        }

        .order-info input,
        .order-info select {
            height: 35px;
            width: 100%;
            margin-top: 5px;
            padding: 0 7px;
        }

        .order-info textarea {
            width: 100%;
            padding: 0 7px;
        }

        .order-info label {
            display: block;
            font-size: 1.7rem;
            margin-top: 20px;
        }


        .order-info .time {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 13px; 
        }

        .btn-pay-enabled {
            background: #146EBE;
        }

        .btn-pay {
            transition: all 0.2s ease-in-out;
            text-decoration: none
        }

        .btn-pay:hover {
            opacity: 0.9;
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
        
    </style>
@endsection

@section('main')
    <div class="borrow">
        <div class="container">
            @if(true)
                <h2 class="title">
                    MƯỢN SÁCH
                </h2>
                <form action="{{route('submitborrow', ['id' => $foundProduct -> id])}}" method="post">
                    @method('POST')
                    @csrf
                    <div class="left">
                        <div class="product-info">
                            <div class="img">
                                <img src="{{$foundProduct -> image}}" alt="">
                            </div>
                            <div class="content">
                                <h3>{{$foundProduct -> title}}</h3>
                                <p>ISBN: {{$foundProduct -> ISBN}}</p>
                                <p>Tác giả: {{$foundProduct -> author -> name}}</p>
                                @if($foundProduct -> pdf_link)
                                    <a target = "_blank" href="{{$foundProduct -> pdf_link ?? ''}}">Đọc thử</a>
                                @endif
                                <p class="price">{{number_format($foundProduct -> price)}} đ / ngày</p>
                                <input type="hidden" class = "priceHidden" value = "{{$foundProduct -> price}}">
                                
                            </div>
                        </div>
                        <div class="order-info">
                            <h3 class="order-title">
                                Thông tin đơn hàng
                            </h3>
                            <div class="time">
                                <div class="time1">
                                    <label for="">Ngày mượn</label>
                                    <input class = "borrow_date" type="datetime-local" value = "{{date('Y-m-d\TH:i')}}" name="borrow_date" id="">
                                </div>
                                <div class="time1">
                                    <label for="">Ngày trả dự kiến</label>
                                    <input class = "return_date" type="datetime-local" value = "{{date('Y-m-d\TH:i', strtotime('+3 days'))}}" name="return_date" id="">
                                </div>
                            </div>
                            <div class="branch">
                                <label for="">Nhận sách tại</label>
                                <select name="branch" id="">
                                    @foreach($branches as $item) 
                                        <option value="{{$item -> id}}">{{$item -> name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="note">
                                <label for="">Ghi chú</label>
                                <textarea name="" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="total-price">
                            <h3>Thành tiền</h3>
                            <div class = "info-pay">
                                <div>
                                    <p>Giá</p>
                                    <p>{{number_format($foundProduct -> price)}} đ</p>
                                </div>
                                <div>
                                    <p>Số ngày mượn</p>
                                    <p class = "days">0 ngày</p>
                                </div>
                            </div>
                            <div class="pay-price">
                                <p>Tổng Số Tiền</p>
                                <p>0 đ</p>
                            </div>
                            @if(!(auth() -> guard('web') -> user() -> email_verified_at))
                                <p class = "warn"><i class="fa-solid fa-circle-exclamation"></i> Vui lòng xác thực email để đăng ký mượn sách!</p>
                                <a href = "{{route('profile')}}" class = "btn-pay">
                                    THANH TOÁN
                                </a>
                            @else 
                                <button class = "btn-pay">
                                    THANH TOÁN
                                </button>
                            @endif
                            
                        </div>
                    </div>
                </form>
            @else
                <h1>404</h1>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            // Lấy các phần tử cần thiết
            const borrowForm = document.querySelector('.borrow form');
            const borrowButton = document.querySelector('.total-price button');
            const borrowPrice = $('.priceHidden').value; 
            

            // Lắng nghe sự kiện khi ngày mượn hoặc ngày trả dự kiến thay đổi
            borrowForm.addEventListener('change', updateTotal);

            // Hàm tính số ngày mượn và tổng tiền mượn sách
            function updateTotal() {
                const borrowStartDate = new Date($('.borrow_date').value);
                const borrowEndDate = new Date($('.return_date').value);

                

                const diffTime = Math.abs(borrowEndDate - borrowStartDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                const totalPrice = diffDays * borrowPrice;

                // Cập nhật số ngày mượn và tổng tiền mượn sách
                const infoPay = document.querySelector('.info-pay');
                const daysElement = infoPay.querySelector('.days');
                
                const totalPriceElement = document.querySelector('.pay-price p:nth-child(2)');
                

                daysElement.textContent = diffDays + ' ngày';
                totalPriceElement.textContent = totalPrice.toLocaleString() + ' đ';

                // Kiểm tra nếu ngày trả dự kiến nhỏ hơn ngày mượn thì vô hiệu hóa nút thanh toán
                if (borrowEndDate < borrowStartDate) {
                    borrowButton.disabled = true;
                    borrowButton.classList.remove('btn-pay-enabled');
                    alert('Ngày trả dự kiến phải lớn hơn này mượn!');
                } else {
                    borrowButton.disabled = false;
                    borrowButton.classList.add('btn-pay-enabled');
                }
            }

            // Mặc định gọi hàm để tính số ngày mượn và tổng tiền mượn sách
            updateTotal();
        });
    </script>
@endsection
