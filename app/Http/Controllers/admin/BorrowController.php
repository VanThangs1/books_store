<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Mail\BorrowNotiEMail;
use App\Repositories\Eloquent\BorrowEloquentRepository;
use App\Repositories\Eloquent\CustomerEloquentRepository;
use App\Repositories\Eloquent\ProductEloquentRepository;

class BorrowController extends Controller
{
    protected $borrowRepository;
    protected $customerRepository;
    protected $productRepository;

    public function __construct(
        BorrowEloquentRepository $borrowRepository,
        CustomerEloquentRepository $customerRepository,
        ProductEloquentRepository $productRepository
        ) {
        $this -> borrowRepository = $borrowRepository;
        $this -> customerRepository = $customerRepository;
        $this -> productRepository = $productRepository;
    }

    public function index(Request $request) {
        $filter = $this -> handleFilter($request);
        if(count($filter) > 0) {
            $borrows = $this -> borrowRepository -> filterBorrows(
                $filter['limit'] ?? 5, 
                $filter['sort_filter'] ?? null,
                $filter['id'] ?? null,
                $filter['time_filter'] ?? null,
                'all',
                null
            );
        }else {
            $borrows  = $this -> borrowRepository -> paginateWhereOrderBy([], 'updated_at','DESC', $request -> page ?? 1, 5, ['*']);
        }
        $current_filters = $request ->all();
        
        return view('admin.borrows.index', compact('borrows', 'current_filters'));
    }

    public function filterByUser(Request $request) {
        $user_id = $request -> route('user_id');
        $filter = $this -> handleFilter($request);
        
        $borrows = $this -> borrowRepository -> filterBorrows(
            $filter['limit'] ?? null, 
            $filter['sort_filter'] ?? null,
            $filter['id'] ?? null,
            $filter['time_filter'] ?? null,
            $request -> route('type'),
            $user_id
        );
        
        $current_filters = $request -> all();
        return view('admin.borrows.index', compact('borrows', 'current_filters'));
    }

    public function createForm(Request $request) {
        if($request -> user_id) {
            $customers = [$this -> customerRepository -> findById($request -> user_id)];
        }else{
            $customers = $this -> customerRepository -> allCustomer();
        }
        
        if($request -> product_id) {
            $products = [$this -> productRepository -> findById($request -> product_id)];
        }else {
            $products = $this -> productRepository -> findWhere([
                'status' => '1',
                'type' => '1',
                ['quantity', '>', '0']
            ]);
        }
        
        return view('admin.borrows.create', compact('customers', 'products'));
    }

    public function handleCreate(Request $request) {
        $validated = $request -> validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'borrow_date' => 'required',
            'return_date' => 'required'
        ]);

        $foundProduct = $this-> productRepository->findById($request -> product_id);
        $foundUser = $this -> customerRepository -> findById($request -> user_id);

        
        if($foundProduct -> quantity <= 0) {
            return redirect() -> route('admin.borrow.create') -> with(['error' => "Sách không có sẵn!"]);
        }

        $request -> merge([
            'branch_id' => '1'
        ]);

        $this -> borrowRepository -> create($request -> all());

        return redirect() -> route('admin.borrows') -> with(['success' => "Tạo thành công đơn mượn sách!"]);
    }

    // Sửa đơn mượn
    public function editForm(Request $request) {
        if($request -> user_id) {
            $customers = [$this -> customerRepository -> findById($request -> user_id)];
        }else{
            $customers = $this -> customerRepository -> allCustomer();
        }
       
        if($request -> product_id) {
            $products = [$this -> productRepository -> findById($request -> product_id)];
        }else {
            $products = $this -> productRepository -> findWhere([
                'status' => '1',
                'type' => '1',
                ['quantity', '>', '0']
            ]);
        }

        $foundBorrow = $this -> borrowRepository -> findById($request -> id);
        // dd($foundBorrow);
        return view('admin.borrows.edit', compact('foundBorrow', 'customers', 'products'));
    }

    public function handleEdit(Request $request) {
        $validator = $request -> validate([
            'borrow_date' => 'required',
            'return_date' => 'required'
        ]);
        $foundBorrow = $this -> borrowRepository -> findById($request -> id);
        
        $this -> borrowRepository -> update($request -> all(), $foundBorrow -> id);

        return redirect() -> route('admin.borrow.edit', $foundBorrow -> id) -> with('success', 'Updated Borrow');
    }

    public function handleFilter(Request $request) {
        $filterOptions = [
            'limit',
            'sort_filter',
            'id',
            'time_filter',
            'type'
        ];
        
        $filterValue = [];
        
        foreach ($filterOptions as $key => $value) {
            if ($request->has($value)) {
                $filterValue[$value] = $request->input($value);
            }
        }
        return $filterValue;
    }

    public function filterByProduct(Request $request) {
        $product_id = $request -> route('product_id');
        
        $borrows  = $this -> borrowRepository -> paginateWhereOrderBy(['product_id' => $product_id], 'updated_at','DESC', $request -> page ?? 1, 4, ['*']);

        return view('admin.borrows.index', compact('borrows'));
    }
}
