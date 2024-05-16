@php
    $currentPage = $pagination -> currentPage();
    $lastPage = $pagination -> lastPage();
    $path = $pagination->path();
    $query = http_build_query(request()->except('page'));
    $total = $pagination -> total();
@endphp


@if($total > 0)
    <div class="custom-pagination">
        <div>
            Hiển thị trang {{$currentPage}} trên {{$lastPage}} trang
        </div>
        <div>
            <ul>
                @if($currentPage > 1)
                    <li class = "active-color"><a href="{{$path}}?page={{$currentPage > 1 ? $currentPage - 1 : $currentPage}}{{$query ? '&'.$query : ''}}">Prev</a></li>
                @else
                    <li>Prev</li>
                @endif
                @for($i = 1; $i <= $lastPage; $i++)
                    @if((request() -> page ?? 1) == $i)
                        <li class = "active" style = "color: red">
                            <a href="{{$path}}?page={{$i}}{{$query ? '&'.$query : ''}}">{{$i}}</a>
                        </li>
                    @else
                        <li>
                            <a href="{{$path}}?page={{$i}}{{$query ? '&'.$query : ''}}">{{$i}}</a>
                        </li>
                    @endif
                @endfor
                @if($currentPage < $lastPage)
                    <li class = "active-color"><a href="{{$path}}?page={{$currentPage < $lastPage ? $currentPage + 1 : $currentPage}}{{$query ? '&'.$query : ''}}">Next</a></li>
                @else
                    <li>Next</li>
                @endif
            </ul>
        </div>
    </div>
@else
    <div style = "width: 100%; text-align: center">
        Không có dữ liệu
    </div>
@endif