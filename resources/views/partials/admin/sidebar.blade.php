l@php
    use Illuminate\Support\Str;
    $menus = [
        [
            "title" => "Dashboard",
            "route" => route('admin.dashboard'),
        ],
        [
            "title" => "Khách hàng",
            "route" => route('admin.customers')
        ],
        [
            "title" => "Tác giả",
            "subroute" => [
                [
                    "title" => "Danh sách tác giả",
                    "route" => route('admin.authors')
                ],
                [
                    "title" => "Thêm tác giả",
                    "route" => route('admin.author.create'),
                ],
                
            ]
        ],
        [
            "title" => "Danh mục",
            "subroute" => [
                [
                    "title" => "Danh sách danh mục",
                    "route" => route('admin.categories')
                ],
                [
                    "title" => "Thêm danh mục",
                    "route" => route('admin.category.create'),
                ],
                
            ]
        ],
        [
            "title" => "Sản phẩm",
            "subroute" => [
                [
                    "title" => "Danh sách bán",
                    "route" => route('admin.products'),
                ],
                [
                    "title" => "Danh sách cho mượn",
                    "route" => route('admin.product.borrowproducts'),
                ],
                [
                    "title" => "Thêm sản phẩm",
                    "route" => route('admin.product.create'),
                ]
            ]
        ],
        [
            "title" => "Đơn hàng",
            "subroute" => [
                [
                    "title" => "Đơn bán",
                    "route" => route('admin.orders'),
                ],
                [
                    "title" => "Đơn mượn",
                    "route" => route('admin.borrows')
                ],
                [
                    "title" => "Tạo đơn mượn",
                    "route" => route('admin.borrow.create')
                ],
                [
                    "title" => "Thống kê",
                    "route" => route('admin.statistics')
                ],
                [
                    "title" => "Quản lý giao dịch",
                    "route" => "https://sandbox.vnpayment.vn/merchantv2/Users/Login.htm?ReturnUrl=%2fmerchantv2%2fUsers%2fLogout.htm"
                ]
            ]
        ],
    ];

    function renderMenu($menus) {
        foreach($menus as $menu){
            if(isset($menu['subroute'])){
                echo "<li  class='has_sub'>
                    <a href='javascript:void(0);' class='waves-effect'><i class='mdi mdi-email-outline'></i><span> ".$menu['title']." <span class='pull-right'><i class='mdi mdi-chevron-right'></i></span> </span></a>";
                echo "<ul class='list-unstyled'>";
                   
                    renderMenu($menu['subroute']);
                echo "</ul> </li>";
            }    
            else{
                echo "<li><a href='" .$menu["route"]. "' class='waves-effect'><i class='mdi mdi-cube-outline'></i><span>". $menu['title']." </span></a></li>";
            }     
        }
    }
@endphp

    <div id="sidebar-menu">
        <ul>
            {{renderMenu($menus)}}
        </ul>
    </div>

