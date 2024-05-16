@php 
    $sort_option = [
        "latest" => "Mới nhất",
        "oldest" => "Cũ nhất",
        "price_asc" => "Giá tăng dần",
        "price_desc" => "Giá giảm dần",
        "a_z" => "Từ A-Z",
        "z_a" => "Từ Z-A",
    ];

    $limit_option = [
        5, 10, 20, 30, 50    
    ];

    $status_option = [
        "2" => "Tất cả",
        "1" => "Enabled",
        "0" => "Disabled"
    ];

    $hasFilter = !empty(request()->categories);
    $hasAuthorFilter = !empty(request()->authors);

@endphp


<div class="sidebar-filter">
    <form class = "form-filter">
        <h1>LỌC THEO</h1>
        @if(request() -> type)
            <input type="hidden" name="type" value = "{{request() -> type}}">
        @endif
        @if(request() -> search)
            <input type="hidden" name="search" value = "{{request() -> search}}">
        @endif
        <div class="btn-control">
            <a href="{{route('search')}}">Bỏ lọc</a>
            <button href="">Lọc</button>
        </div>
        <div class="sort-by">
            <h4>Sắp xếp theo</h4>
            <select name="sort" id="sort">
                @foreach($sort_option as $key => $item)
                    @if(request() -> sort == $key) 
                        <option selected value="{{$key}}">{{$item}}</option>
                    @else 
                        <option value="{{$key}}">{{$item}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="price">
            <h4>Giá</h4>
            <div class="price-progress">
                <div class="progress">
                    
                </div>
                <div class="range-input">
                    <input type="range" class="min" min = "0" max = "10000000" value = "{{request() -> price_min ?? 0}}">
                    <input type="range" class="max" min = "0" max = "10000000" value = "{{request() -> price_max ?? 10000000}}">
                </div>
            </div>
            <div class="price-input">
                Từ: <input class = "price_min" name = "price_min" type="number" min = "0" max = "10000000" value = "0">
                Đến: <input class = "price_max" name = "price_max" type="number" min = "0" max = "10000000" value = "10000000">
            </div>
        </div>
        <div class="categories">
            <h4>Danh mục</h4>
            <div class="cate-list list">
           
            @foreach($categories as $value)
                <div class="cate-item">
                    <input type="checkbox" name="categories[]" value="{{ $value->id ?? '' }}" {{ $hasFilter && in_array($value->id, request()->categories) ? 'checked' : '' }}>
                    <p>{{ $value->title }}</p>
                </div>
            @endforeach

            </div>         
        </div>
        <div class="authors">
            <h4>Tác giả</h4>
            <div class="author-list list">
                @foreach($authors as $value)
                    <div class="cate-item">
                        <input type="checkbox" name="authors[]" value="{{ $value->id ?? '' }}" {{ $hasAuthorFilter && in_array($value->id, request()->authors) ? 'checked' : '' }}>
                        <p>{{ $value->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </form>
</div>


@section('scripts')
    <script>
        const form = $('.form-filter');
        const progress = $('.price-progress .progress');
        $('.sort-by #sort').addEventListener('change', () => {
            form.submit();
        })

        $('.price_min').addEventListener('blur', () => {
            form.submit();
        })

        $('.price_max').addEventListener('blur', () => {
            form.submit();
        })

        const rangeInput = $$('.range-input input');

        let submitSet;
        let priceGap = 100000;

        let minValue = parseInt(rangeInput[0].value);
        let maxValue = parseInt(rangeInput[1].value);

        function setStyleProgress(minValue, maxValue, priceGap, e) {
            console.log(maxValue-minValue);
            if(maxValue - minValue < priceGap){
                if(e.target.className === 'min') {
                    rangeInput[0].value = maxValue - priceGap;
                    $('.price_min').value = maxValue - priceGap;
                }else {
                    rangeInput[1].value = minValue + priceGap;
                    $('.price_max').value = minValue + priceGap;
                }
            }
            else {
                progress.style.left = (minValue / rangeInput[0].max) * 100 + '%';
                progress.style.right = 100 - (maxValue / rangeInput[1].max) * 100 + '%';
                $('.price_min').value = minValue;
                $('.price_max').value = maxValue; 
            }      
        }

        setStyleProgress(minValue, maxValue, priceGap);

        rangeInput.forEach(input => {
            input.addEventListener('input', (e) => {
                clearTimeout(submitSet);
                let minValue = parseInt(rangeInput[0].value);
                let maxValue = parseInt(rangeInput[1].value);

                $('.price_min').value = minValue;
                $('.price_max').value = maxValue;

                setStyleProgress(minValue, maxValue, priceGap, e);

                submitSet = setTimeout(() => {
                    form.submit();
                }, 1000);
            });
        })
    </script>
@endsection