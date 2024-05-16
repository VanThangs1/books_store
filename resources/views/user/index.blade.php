@extends('layouts.user-layout')

@section('style')
    <style>
        .home {
            display: flex;
            justify-content: center;
        }

        .home .container {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 7px;
            margin-bottom: 20px;
        }

        .home .container > div {
            background-color: #fff;
            border-radius: 5px;
            min-height: 100px;
            padding: 13px 20px;
        }

        .home .container > div .title {
            border-bottom: 1px solid #eee;
            font-size: 2rem;
            font-weight: 500;
            padding-bottom: 7px;
            opacity: 0.8;
        }

        .cate-list {
            padding: 13px 0;
            padding-bottom: 10px;
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            grid-gap: 7px;
        }

        .cate-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 1.5rem;
            cursor: pointer;
            text-align: center;
        }

        .cate-item img {
            transition: 0.2s all ease-in-out;
        }


        .cate-item:hover img {
            opacity: 0.9;
            scale: 1.1;
        }

        .cate-title {
            margin-top: 3px;
            transition: 0.3s all ease-in-out;
            font-weight: 400;
        }

        .cate-item:hover .cate-title {
            color: #55C1FF;
        }

        .product-list {
            margin-top: 13px;
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            grid-gap: 1px;
            
        }

        .product-item {
            cursor: pointer;
            height: 150px;
            display: flex;
            justify-content: center;
        }

        .product-item img {
            height: 100%;
            object-fit: cover;
        }

        .product-item:hover {
            opacity: 0.9;
        }
    </style>
@endsection

@section('main')
    <div class="home">
        <div class="container">
            <div class="categories">
                <h2 class="title">Danh Mục</h2>
                <div class="cate-list">
                    @foreach($categories as $item)
                        <a class="cate-item">
                            <div class="img">
                                <img src="{{$item -> thumbnail}}" alt="{{$item -> title}}">
                            </div>
                            <p class="cate-title">{{$item -> title}}</p>
                        </a>
                    @endforeach
                    
                    
                </div>
            </div>
            <div class="products">
                <h2 class="title">Sách Cho Mượn</h2>
                <div class="product-list">
                    @foreach($products as $item)
                        <a href = "{{route('product_detail', ['slug' => $item -> slug])}}" class="product-item" title = "{{$item -> title ?? ''}}">
                            <div class="img">
                                <img src="{{$item -> image ?? ''}}" alt="">
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection