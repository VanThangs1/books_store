@extends('layouts.user-onlyheader-layout')

@section('style')
    <style>
        .authors-list {
            display: flex;
            justify-content: center;
        }

        .authors-list .title {
            margin-top: 5px;
            margin-bottom: 10px;
            font-size: 2rem;
            font-weight: 500;
        }

        .authors-list .container {
           
        }

        .masonry-container {
            column-count: 5; /* Số cột */
            column-gap: 15px; /* Khoảng cách giữa các cột */
            margin: 15px;
        }

        .masonry-item {
            display: inline-block;
            width: 100%;
            margin-bottom: 15px;
            box-sizing: border-box;
            position: relative; /* Để có thể chứa phần info */
            border-radius: 8px;
            overflow: hidden; /* Tránh hình ảnh bị tràn ra khỏi góc */
            transition: transform 0.3s ease; /* Hiệu ứng hover */
            cursor: pointer;
        }

        .masonry-item:hover {
            transform: scale(1.05); /* Phóng to khi hover */
        }

        .masonry-item img {
            width: 100%;
            display: block;
            
        }

        .info {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            text-align: center;
            box-sizing: border-box;
            transition: opacity 0.3s ease; /* Hiệu ứng hover */
            opacity: 0; /* Mặc định ẩn đi */
        }

        .masonry-item:hover .info {
            opacity: 1; /* Hiện khi hover */
        }

        .info p {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        .authors-list .search {
            margin: 15px 0; /* Spacing between the search box and the Masonry layout */
            text-align: center; /* Center the content in the search box */
        }

        .authors-list .search input {
            /* Add styling for the search input field */
            padding: 10px 8px;
            width: 400px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .authors-list .search input:focus {
            outline: none;
            border: 1px solid #83A2FF;
        }

        .authors-list .search button {
            /* Add styling for the search button */
            padding: 10px 13px;
            border: none;
            background-color: #83A2FF;
            color: white; /* White text color */
            border-radius: 4px;
            cursor: pointer;
        }

        /* Style the button on hover */
        .authors-list .search button:hover {
            opacity: 0.9;
        }
   
    </style>
@endsection

@section('main')
    <div class="authors-list">
        <div class="container">
            <h2 class = "title">TÁC GIẢ({{count($authors)}})</h2>
            <form action="" class="search">
                <input type="text" name = "search" value = "{{$q ?? ''}}" placeholder = "Tìm kiếm tác giả...">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            @if(count($authors))
                @if(request() -> search != '') 
                    <h2 align = "center">Tìm thấy <span style = "color: #0866FF">{{count($authors)}}</span> kết quả cho từ khóa <span style = "color: #0866FF">"{{request() -> search}}"</span></h2>
                @endif
                <div class="masonry-container">
                    @foreach($authors as $item)
                        <div class="masonry-item" onclick="open_href('{{ route('author_detail', ['slug' => $item->slug]) }}')" title="{{$item->name}}">
                            <img src="{{$item->image}}" alt="{{$item->name}}">
                            <div class="info">
                                <p>{{$item->name}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="not-found">
                    <h2 align = "center" style = "margin-bottom: 20px">Không có kết quả cho từ khóa <span style = "color: #0866FF">"{{request() -> search}}"</span></h2>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    
@endsection
