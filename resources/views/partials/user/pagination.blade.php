@php
    $currentPage = $pagination -> currentPage();
    $lastPage = $pagination -> lastPage();
    $path = $pagination->path();
    $query = http_build_query(request()->except('page'));
    $total = $pagination -> total();
@endphp


@if($total > 0)
    <div class="custom-pagination">
        <ul>
            @if($currentPage > 1)
                <li class = "active-color"><a href="{{$path}}?page={{$currentPage > 1 ? $currentPage - 1 : $currentPage}}{{$query ? '&'.$query : ''}}"><i class="fa-solid fa-chevron-left"></i></a></li>
            @else
                <li><i class="fa-solid fa-chevron-left"></i></li>
            @endif
            @for($i = 1; $i <= $lastPage; $i++)
                @if((request() -> page ?? 1) == $i)
                    <li class = "active" style = "color: red">
                        <a href="{{$path}}?page={{$i}}{{$query ? '&'.$query : ''}}">{{$i}}</a>
                    </li>
                @else
                    <li class = "active-color">
                        <a href="{{$path}}?page={{$i}}{{$query ? '&'.$query : ''}}">{{$i}}</a>
                    </li>
                @endif
            @endfor
            @if($currentPage < $lastPage)
                <li class = "active-color"><a href="{{$path}}?page={{$currentPage < $lastPage ? $currentPage + 1 : $currentPage}}{{$query ? '&'.$query : ''}}"><i class="fa-solid fa-chevron-right"></i></a></li>
            @else
                <li><i class="fa-solid fa-chevron-right"></i></li>
            @endif
        </ul>
    </div>
@else
    <div style = "width: 100%; text-align: center">
        Không có dữ liệu
    </div>
@endif