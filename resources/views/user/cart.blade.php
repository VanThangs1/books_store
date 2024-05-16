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
        .cart-content .left .cart-header,
        .cart-content .left .cart-body {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px 13px;
        }

        .cart-content .left .cart-header {
            margin-bottom: 10px;
            padding: 13px;
            display: flex;
            justify-content: space-between;
        }

        .cart-body .product-item {
            display: flex;
        }

        .cart .info {
            flex:1;
            display: flex;
        }
        .cart .info img {
            height: 100px;

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
        }

        .detail-info .price {
            display: flex;
            align-items: flex-end;
            margin-top: 20px;
        }

        .detail-info .price .real-price {
            color: #000;
            font-size: 1.7rem;
            font-weight: 500;
            padding-right: 7px;
        }

        .detail-info .price .old-price {
            color: #8491A3;
            font-weight: 300;
            font-size: 1.5rem;
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
            font-size: 1.8rem;
            
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

        
    </style>
@endsection

@section('main')
    <div class="cart">
        <div class="container">
            <h2 class="title">
                GIỎ HÀNG ({{$count}} sản phẩm)
            </h2>
            <div class="cart-content">
                <div class="left">
                    <div class="cart-header">
                        <div class="select">
                            <input type="checkbox" name = "selected-all">
                        </div>
                        <div class = "info" style = "margin-left: 7px">
                            <span>Chọn tất cả ({{$count}} sản phẩm)</span>
                        </div>
                        <div class = "item-quantity">
                            <span>Số lượng</span>
                        </div>
                        <div class = "item-total">
                            <span>Thành tiền</span>
                        </div>
                        <div class = "item-action">
                            
                        </div>
                    </div>
                    <div class="cart-body">
                        @php 
                            $total = 0;
                        @endphp 
                        @foreach($productsInCart as $product)
                            <div class="product-item" data-product-id = "{{$product -> id}}">
                                <div class="select">
                                    <input type="checkbox" name="" id="">
                                </div>
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
                                    <input type="number" min = "1" max = "{{$product -> quantity}}" value = "{{$product -> quantityInCart}}" style = "width: 50px">
                                </div>

                                <div class = "item-total">
                                    @php 
                                        $productTotal = $product -> price * $product -> quantityInCart;
                                        $total += $productTotal;
                                        $count++;
                                    @endphp
                                    {{number_format($productTotal)}} ₫
                                </div>
                                <form action = "{{route('removeCart', ['productId' => $product -> id])}}" method = "POST" class = "item-action">
                                    <button><i class="fa-solid fa-trash"></i></button>
                                    @csrf
                                    @method('POST')
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="right">
                    <div class="total-price">
                        <h3>Thành tiền</h3>
                        <div class="pay-price">
                            <p>Tổng Số Tiền</p>
                            <p>0 ₫</p>
                        </div>
                        @if(!Auth::guard('web') -> check())
                            <p class = "warn"><i class="fa-solid fa-circle-exclamation"></i> Vui lòng đăng nhập tài khoản trước khi thanh toán!</p>
                        @endif
                        <button class = "btn-pay">
                            THANH TOÁN
                            @csrf
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy tất cả các phần tử checkbox trong giỏ hàng
            const checkboxes = $$('.cart-body .select input[type="checkbox"]');
            const prices = $$('.item-quantity input[type="number"]');

            function setBtnPayStatus(checkedOne) {
                if(checkedOne) $('.btn-pay').classList.add('btn-pay-enabled');
                else $('.btn-pay').classList.remove('btn-pay-enabled');
            }

            function checkSelectAllCheckbox() {
                const selectAllCheckbox = $('.cart-header .select input[type="checkbox"]');
                const checkboxes = $$('.cart-body .select input[type="checkbox"]');

                let allChecked = true;
                let checkedOne = false;
                checkboxes.forEach(function(checkbox) {
                    if (!checkbox.checked) {
                        allChecked = false;
                    }else {
                        checkedOne = true;
                    }
                });
                setBtnPayStatus(checkedOne);
                selectAllCheckbox.checked = allChecked;
            }

            // Lắng nghe sự kiện khi người dùng click vào checkbox
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener("change", function() {
                    calculateTotalPrice();
                    checkSelectAllCheckbox();
                });
            });

            

            prices.forEach(function(checkbox) {
                checkbox.addEventListener("change", function() {
                    calculateTotalPrice();
                });
            });

            function selectAllProducts(checked) {
                const productItems = $$('.cart-body .product-item');
                const checkboxes = $$('.cart-content .select input[type="checkbox"]');
                
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = checked;
                });

                calculateTotalPrice();
            }

            const selectAllCheckbox = $('.cart-header .select input[type="checkbox"]');
            selectAllCheckbox.addEventListener("change", function() {
                selectAllProducts(this.checked);
                setBtnPayStatus(this.checked);
            });

            
            function setChecked(count) {
                if(count == checkboxes.length) {
                    alert("Hello");
                }
            }

            // Tính tổng tiền
            function calculateTotalPrice() {
                const productItems = $$('.cart-body .product-item');
                let total = 0;

                // Lặp qua tất cả các mục sản phẩm
                productItems.forEach(function(item) {
                    const checkbox = item.querySelector('.select input[type="checkbox"]');
                    const itemQuantity = item.querySelector('.item-quantity input[type="number"]').value ?? 0;
                    const itemTotal = item.querySelector('.item-total');
                    const realPrice = item.querySelector('.real-price');

                    // Kiểm tra xem checkbox được chọn hay không
                    const price = parseInt(realPrice.innerText.replace(/\D/g, ''));

                    item.querySelector('.item-total').innerText = formatCurrency(price * itemQuantity);
                                       
                    if (checkbox.checked) {
                        total += price * itemQuantity;
                    }
                });

                // Cập nhật tổng tiền trên giao diện
                const totalPriceElement = $('.right .total-price .pay-price p:nth-child(2)');
                totalPriceElement.innerText = formatCurrency(total);
            }

            // Hàm định dạng số tiền thành định dạng tiền tệ
            function formatCurrency(amount) {
                return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
            }
        });


        function getSelectedProducts() {
            var selectedProducts = [];
            var checkboxes = document.querySelectorAll('.product-item input[type="checkbox"]:checked');

            checkboxes.forEach(function(checkbox) {
                var productId = checkbox.closest('.product-item').getAttribute('data-product-id');
                var quantity = checkbox.closest('.product-item').querySelector('.item-quantity input').value;
                
                selectedProducts.push({
                    productId: productId,
                    quantity: quantity
                });
            });

            var csrfToken = $(".btn-pay input[type='hidden']").value;
            // Gửi thông tin sản phẩm đến server
            fetch("{{route('updateOrder')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(selectedProducts)
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Error ' + response.status);
                }
                return response.json();
            })
            .then(function(data) {
                var pattern = /^(?:\w+:)?\/\/([^\s.]+\.\S{2}|localhost[:?\d]*)\S*$/;
                if(pattern.test(data)) {
                    window.location.href = data;
                }
                
            })
            .catch(function(error) {
                // Xử lý lỗi
                console.error(error);
            });
        }

        $('.btn-pay').addEventListener('click', getSelectedProducts);
    </script>
@endsection
