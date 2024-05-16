@extends('layouts.user-onlyheader-layout')

@php 
    $path = request() -> path();
    $query = http_build_query(request()->except('type'));

    $allCount = $products2->count();
    $sellCount = $products2->filter(function ($product) {
        return $product->type == '0';
    })->count();

    $borrowCount = $products2->filter(function ($product) {
        return $product->type == '1';
    })->count();
    
    $types = [
        [
            "typeid" => "all",
            "name" => "Tất cả",
            "quantity" => $allCount
        ],
        [
            "typeid" => "sell",
            "name" => "Sách bán",
            "quantity" => $sellCount
        ],
        [
            "typeid" => "borrow",
            "name" => "Sách mượn",
            "quantity" => $borrowCount
        ]
    ];

    $pagination = $products;
    
@endphp

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/user-page/search.css')}}">
    
    <style>
        .product-item img{
            max-height: 186.75px;
            object-fit: contain;
        }

        .product-item .title {
            height: 45px;
        }

        .search-content .pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 40px;
            margin-top: 13px;
        }
    </style>
@endsection

@section('main')
    <div class="main-content search-content">
        <div class="container">
            <div class="left">
                @include('partials.user.sidebar-filter')
            </div>
            <div class="right">
                <div class="search-rs">
                    @if(request() -> search)
                        <h2>Kết tìm kiếm cho từ khóa "{{request() -> search ?? ''}}"</h2>
                    @endif
                    <div class="type-flag">
                        @foreach($types as $type) 
                            @if(request() -> type == $type['typeid'] ?? false)
                                <a href="#{{$type['typeid']}}" class = "item active">{{$type['name']}}({{$type['quantity']}})</a>
                            @else
                                @if($type['typeid'] == 'all' && !request() -> type)
                                    <a href="{{$path}}?type={{$type['typeid']}}{{$query ? '&'.$query : ''}}" class = "item active">{{$type['name']}}({{$type['quantity']}})</a>
                                @else
                                    <a href="{{$path}}?type={{$type['typeid']}}{{$query ? '&'.$query : ''}}" class = "item">{{$type['name']}}({{$type['quantity']}})</a>
                                @endif
                            @endif
                        @endforeach
                    </div>  
                    <div class="product-list">
                        @foreach($products as $item)
                            <a class="product-item" href = "{{route('product_detail', ['slug' => $item -> slug])}}">
                                @if($item -> type == '1')
                                    <div class="typebusiness">Cho mượn</div>
                                @endif
                                <img src="{{$item -> image}}" alt="{{$item -> title}}">
                                <p class="title">{!!$item -> title!!}</p>
                                <div class="real-price">{{number_format($item -> price)}} ₫</div>
                                @if($item -> type == '0')
                                    <div class="old-price">{{number_format($item -> price)}} ₫</div>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
                @if($products -> lastpage() > 1)
                    <div class="pagination">
                        @include('partials.user.pagination')
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection