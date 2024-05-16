<header class="header">
    <div class="container">
        @include('partials.user.logo')
        <div class="control">
            <form class="search" action = "{{route('search')}}">
                <input type="text" name = "search" value = "{{request() -> search ?? ''}}" placeholder = "Tìm kiếm...">
                
                <a href="{{route('search')}}"><i class="fa-solid fa-magnifying-glass"></i></a>
            </form>
            <div class="menu">
                <a href="" class="noti">
                    <p class="icon" data-noti = "99+"><i class="fa-solid fa-bell"></i></p>
                    <p class="text">Thông báo</p>
                </a>
                <a href="{{route('cart')}}"  class="cart">
                    <p data-noti = "{{session() -> get('cart') != null && count(session() -> get('cart')) > 0 ? count(session() -> get('cart')) : ''}}" class="icon"><i class="fa-solid fa-cart-shopping"></i></p>
                    <p class="text">Giỏ hàng</p>
                </a>
                @if(Auth::guard('web') -> check()) 
                    <div class="account-login" style="z-index:10">
                        <a href="{{route('profile')}}">
                            <p class="icon"><i class="fa-solid fa-user"></i></p>
                            <p class="text">{{Auth::guard('web') -> user() -> name}}</p>
                        </a>
                        <ul class = "user-menu">
                            <li><a href="{{route('profile')}}">Thông tin cá nhân</a></li>
                            <li><a href="{{route('order')}}">Đơn hàng</a></li>
                            <li><a href="">Đơn mượn</a></li>
                            <li><a href="{{route('handle-logout')}}">Đăng xuất</a></li>
                        </ul>
                    </div>
                @else 
                    <div  class="account" style="z-index:10">
                        <a href="{{route('auth')}}">
                            <p class="icon"><i class="fa-solid fa-user"></i></p>
                            <p class="text">Tài khoản</p>
                        </a>
                    </div>                    
                @endif
            </div>
        </div>
    </div>
</header>