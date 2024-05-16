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

        .cart-content .left .cart-header {
            background-color: #fff;
            border-radius: 5px;
        }
        .cart-content .left .cart-body {
            background-color: #fff;
            border-radius: 5px;
            padding: 13px;
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


        .cart .info .id {
            width: 70px;
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
            width: 140px;
            padding-left: 7px;
        }

        .cart .item-date {
            width: 150px;
            padding-left: 7px;
        }

        .cart .item-status {
            width: 180px;
            padding-left: 7px;
        }

        .cart-body .item-total {
            color: #146EBE;
            font-size: 1.7rem;
            font-weight: 500;
        }

        .cart .item-total,
        .cart .item-status,
        .cart .item-date {
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

        .detail-info {
            flex: 1;
            padding-top: 5px;
            max-width: 250px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
        }

        .detail-info .price {
            display: flex;
            align-items: flex-end;
            margin-top: 20px;
        }

        .action {
            width: 100px;
            text-align: center;
        }

        

        .product-item {
            padding: 13px 0;
            border-bottom: 1px solid #ccc;
        }

        .product-item:nth-last-child(1) {
            border: none;
            padding-bottom: 0;
        }

        .statistical {
            padding: 13px 20px;
            background: #fff;
            border-radius: 5px;
        }

        .statistical h2{
            font-weight: 500;
            margin-bottom: 13px;
        }

        .statistical p {
            margin-top: 5px;
            font-size: 1.7rem;
        }

        .statistical .all {
            font-weight: 500;
        }

        .statistical p:nth-child(3) {
            color: #FFC107;
        }

        .statistical p:nth-child(4) {
            color: #FF9800;
        }

        .statistical p:nth-child(5) {
            color: #4CAF50;
        }

    </style>
@endsection

@section('main')
    <form class="cart" action = "{{route('submitOrder')}}" method = "POST">
        <div class="container">
            <h2 class="title">
                ĐƠN HÀNG CỦA TÔI
            </h2>
            <div class="cart-content">
                <div class="left">
                    <div class="cart-header">
                        <div class = "info" style = "margin-left: 7px">
                            <span style = "font-weight: 500">Danh sách đơn hàng</span>
                        </div>
                        <div class = "item-date">
                            <span>Ngày đặt</span>
                        </div>
                        <div class = "item-status">
                            <span>Trạng thái</span>
                        </div>
                        <div class = "item-total">
                            <span>Tổng tiền</span>
                        </div>
                        <div class = "action">
                            <span></span>
                        </div>
                    </div>

                    @php 
                        $prepare = 0;
                        $shipping = 0;
                        $shipped = 0;
                    @endphp
                    <div class="cart-body">
                        @foreach($orders as $order)  
                            <div class="product-item" >
                                <div class="info">
                                    <div class="id"><strong>#{{$order -> id}}</strong></div>
                                    <div class="detail-info">
                                        {{$order -> order_title}}
                                    </div>
                                </div>
                                <div class = "item-date">
                                    {{$order -> created_at ? date_format($order -> created_at, 'd/m/Y') : ''}}
                                </div>
                                <div class = "item-status">
                                    @if($order -> order_status == 0) 
                                        <p style = "color: #FFC107">Chuẩn bị hàng</p>
                                        @php 
                                            $prepare++;
                                        @endphp
                                    @elseif($order -> order_status == 1)
                                        <p style = "color: #FF9800">Đang giao hàng</p>
                                        @php 
                                            $shipping++;
                                        @endphp
                                    @else
                                        <p style = "color: #4CAF50">Đã nhận hàng</p>
                                        @php 
                                            $shipped++;
                                        @endphp
                                    @endif
                                </div>

                                <div class = "item-total">
                                    {{number_format($order -> total_amount)}} đ
                                </div>
                                <div class = "action">
                                    <a href="{{route('orderDetail', ['id' => $order -> id])}}">Chi tiết</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                </div>
                <div class="right">
                    <div class="statistical">
                        <h2>Thống kê đơn hàng</h2>
                        <p class = "all">Tổng số: {{count($orders)}}</p>
                        <p>Đang chuẩn bị: {{$prepare}}</p>
                        <p>Đang giao: {{$shipping}}</p>
                        <p>Đã giao: {{$shipped}}</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    
@endsection
