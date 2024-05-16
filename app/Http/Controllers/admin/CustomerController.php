<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Eloquent\CustomerEloquentRepository;

class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerEloquentRepository $customerRepository) {
        $this -> customerRepository = $customerRepository;
    }

    public function index(Request $request) {

        $filters = $this -> handleFilter($request);
        if(count($filters) > 0) {
            $customers = $this -> customerRepository -> filterCustomers(
                $filters['limit'] ?? 5, 
                $filters['sort_filter'] ?? 'latest',
                $filters['search'] ?? null 
            );
        }else {
            $customers  = $this -> customerRepository -> paginateWhereOrderBy(['is_admin' => '0'], 'updated_at','DESC', $request -> page ?? 1, 5, ['*']);
        }

        $current_filters = $request -> all();
        
        return view('admin.customers.index', compact('customers', 'current_filters'));
    }

    public function handleFilter(Request $request) {
        $filterOptions = [
            'limit',
            'sort_filter',
            'search'
        ];
        
        $filterValue = [];
        
        foreach ($filterOptions as $key => $value) {
            if ($request->has($value)) {
                $filterValue[$value] = $request->input($value);
            }
        }
        return $filterValue;
    }
}
