@extends('layouts.user-onlyheader-layout')
@php

@endphp
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/user-page/product-detail.css')}}">
    <style>
        input[type="number"] {
            width: 100px!important;
            height: 35px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            color: #333;
            font-size: 16px;
            text-align: left;
            cursor: pointer;
        }
    </style>
@endsection

@section('main')
    <div class="product-detail">
        <div class="container">
            @if($foundProduct)
                <div class="overview">
                    <div class="left">
                        <div class="img">
                            <img src="{{$foundProduct -> image ?? ''}}" alt="{{$foundProduct -> slug ?? ''}}">
                            <!-- <img src="{{$foundProduct -> author -> image ?? ''}}" alt="{{$foundProduct -> author -> name ?? ''}}"> -->
                        </div>
                        <div class="btn-control">
                            @if($foundProduct -> pdf_link) 
                                <a style = "text-decoration: none" href = "{{$foundProduct -> pdf_link}}" target="_blank"  class = "btn btn-outline">Đọc thử</a>
                            @endif

                            @if($foundProduct -> type == "0")
                                <form method = "POST" action="{{route('addToCart', ['productId' => $foundProduct -> id])}}">
                                    <button class = "btn btn-blue">Thêm vào giỏ hàng</button>
                                    <input type="hidden" class = "addCartQuantity" name = "cart_quantity" value = "1">
                                    @csrf
                                    @method('POST')
                                </form>
                                <form method = "POST" action="{{route('orderNow', ['productId' => $foundProduct -> id])}}" method="post">
                                    <button class = "btn btn-pink">Đặt ngay</button>
                                    <input type="hidden" class = "orderNowQuantity" name = "cart_quantity" value = "1">
                                    @csrf
                                    @method('POST')
                                </form>
                                
                            @else
                                @php 
                                    $borrowurl = route('borrow')."/$foundProduct->slug";
                                @endphp
                                <button class = "btn btn-pink" onclick="open_href('{{$borrowurl}}')">Mượn sách</button>
                            @endif
                        </div>
                    </div>
                    <div class="right">
                        <div class="title">
                            <h3>{{$foundProduct -> title ?? ''}}</h3>
                            <div class="overview-info">
                                <p>ISBN: <span>{{$foundProduct -> ISBN ?? ''}}</span></p>
                                <p>Tác giả: <a target = "_blank" href="{{route('author_detail', ['slug' => $foundProduct -> author -> slug])}}">{{$foundProduct -> author -> name}}</a></p>
                                <p>Ngày xuất bản: <span>{{$foundProduct -> publication_date}}</span></p>
                                <p>Số lượng: <span>{{$foundProduct -> quantity}}</span></p>
                            </div>
                            <div class="price">
                                <div class="real-price">{{number_format($foundProduct -> price)}} đ</div>
                                <div class="old-price">{{number_format($foundProduct -> price)}} đ</div>
                                <div class="discount">25%</div>
                            </div>
                            @if($foundProduct -> type == 0)
                                <div class = "pick-quantity">
                                    <p>Số lượng:</p>
                                    <div class="input-quantity">
                                        <input type="number" min = "1" value = "1" max = "{{$foundProduct -> quantity}}">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="co-author">
                    <div class="product-list">

                    </div>
                </div>
                <div class="product-info">
                    <h2>Thông tin sản phẩm</h2>
                    <div class="product-parameter">
                        
                    </div>
                    <div class="product-des">
                        {!! $foundProduct -> description !!}
                    </div>
                </div>
            @else
                <div>
                    Sản phẩm không tồn tại
                </div>
            @endif
    </div>
@endsection

@section('scripts')
    <script>
        $('.input-quantity input').addEventListener('change', function(e) {
            $('.addCartQuantity').value = e.target.value;
            $('.orderNowQuantity').value = e.target.value;
        })
    </script>
@endsection