<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Charts\SampleChart;

use App\Models\User;

use App\Repositories\Eloquent\OrderEloquentRepository;
use App\Repositories\Eloquent\OrderDetailEloquentRepository;
use App\Repositories\Eloquent\CustomerEloquentRepository;
use App\Repositories\Eloquent\BorrowEloquentRepository;
use App\Repositories\Eloquent\ProductEloquentRepository;

use App\Models\OrderDetail;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $orderDetailRepository;
    protected $customerRepository;
    protected $borrowRepository;

    public function __construct(
        OrderEloquentRepository $orderRepository,
        OrderDetailEloquentRepository $orderDetailRepository,
        CustomerEloquentRepository $customerRepository,
        BorrowEloquentRepository $borrowRepository,
        ProductEloquentRepository $productRepository
        ) {
        $this -> orderRepository = $orderRepository;
        $this -> orderDetailRepository = $orderDetailRepository;
        $this -> customerRepository = $customerRepository;
        $this -> borrowRepository = $borrowRepository;
        $this -> productRepository = $productRepository;
    }

    public function index(Request $request) {
        $orders  = $this -> orderRepository -> paginateWhereOrderBy([], 'updated_at','DESC', 1, 3, ['*']);
        $old_filters = $request -> all();
        return view('admin.orders.index', compact('orders', 'old_filters'));
    }

    public function detail(Request $request) {
        $foundOrder = $this -> orderRepository -> findById($request -> id);
        $products = $this -> orderDetailRepository -> joinFindId('order_id', '=', $foundOrder -> id, 'products', 'product_id', [
            'title',
            
        ]);
        
        return view('admin.orders.detail', compact('foundOrder', 'products'));
    }

    public function changeStatus(Request $request) {
        $foundOrder = $this -> orderRepository -> findById($request -> id);
        $update = $this -> orderRepository -> update([
            'order_status' => $request -> status
        ], $foundOrder -> id);
        return redirect() -> route('admin.orders.detail', $foundOrder -> id) -> with('success', 'Cập nhật trạng thái đơn hàng thành công');
    }

    public function filterOrders(Request $request) {
        $orders = $this -> orderRepository -> filterOrders(
            $request -> sort_filter,
            $request -> status_filter,
            $request -> id,
        );
        return $orders;
    }

    // Thống kê
    public function statistics(Request $request) {
        $countCustomer = $this -> customerRepository -> countWhere(['is_admin' => '0'], ['id']);
        $countOrder = $this -> orderRepository -> countWhere([], ['id']);
        $countBorrow = $this -> borrowRepository -> countWhere([], ['id']);
        $topProducts = $this -> productRepository -> topProducts();
        $topCustomerBorrows = $this -> customerRepository -> topCustomerBorrows();
        $topLateReturners = $this -> customerRepository -> topLateReturners();


        // Biểu đồ khách hàng mượn nhiều nhất
        $chartCustomer = new SampleChart;
        $customerNames = $topCustomerBorrows->pluck('name')->toArray();
        $borrowCounts = $topCustomerBorrows->pluck('borrow_count')->toArray();
        $chartCustomer->labels($customerNames);
        $chartCustomer->dataset('Lượt mượn', 'bar', $borrowCounts);


        // Biểu đồ khách hàng trả muộn nhiều nhất
        $chartCustomerLate = new SampleChart;
        $customerNames = $topLateReturners->pluck('name')->toArray();
        $borrowCounts = $topLateReturners->pluck('late_count')->toArray();
        $chartCustomerLate->labels($customerNames);
        $chartCustomerLate->dataset('Lần muộn', 'bar', $borrowCounts);

        
        // Biểu đồ sản phẩm có lượt mượn nhiều nhất
        $chartProduct = new SampleChart;
        $customerNames = $topProducts->pluck('title')->toArray();
        $borrowCounts = $topProducts->pluck('borrow_count')->toArray();
        $chartProduct->labels($customerNames);
        $chartProduct->dataset('Lượt mượn', 'bar', $borrowCounts);
        

        return view('admin.orders.statistics', 
        compact('countCustomer', 
        'countOrder', 'chartCustomer', 'chartProduct', 'chartCustomerLate',
        'countBorrow',
        ));
    }

    public function CustomerStatistics() {

    }

}
