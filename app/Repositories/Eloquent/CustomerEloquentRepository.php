<?php
namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use App\Repositories\BaseEloquentRepository;
use App\Models\User;
use Carbon\Carbon;

class CustomerEloquentRepository extends BaseEloquentRepository {
    public function model() {
        return User::class;
    }

    public function allCustomer() {
        
        
        $results = $this->model
        ->where('is_admin', '=', '0')
        ->get();
        $this->resetModel();
        return $results;
    }

    public function filterCustomers($limit ,$sort_filter, $search) {
        $query = $this->model->select('users.*')->where('is_admin', '=', '0');
    
        if ($search) {
            $query = $query->where(function($query) use ($search) {
                $query->orWhere('id',"like",  "%$search%")
                    ->orWhere("name", "like", "%$search%")
                    ->orWhere("phone_number", "like", "%$search%")
                    ->orWhere("email", "like", "%$search%");
            });
        }
    
        if ($sort_filter) {
            switch ($sort_filter) {
                case 'latest':
                    $query = $query->orderBy('users.created_at', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('users.created_at', 'asc');
                    break;
                case 'a_z':
                    $query = $query->orderBy('users.name', 'asc');
                    break;
                case 'z_a':
                    $query = $query->orderBy('users.name', 'desc');
                    break;
                default:
                    break;
            }
        }
    
        $results = $query->paginate($limit);
    
        return $results;
    }

    public function topCustomerBorrows()
    {
        $query = $this->model
            ->select('users.id', 'users.name', 'users.email' , \DB::raw('COUNT(borrows.id) as borrow_count'))
            ->leftJoin('borrows', 'users.id', '=', 'borrows.user_id')
            ->groupBy('users.id', 'users.name', 'users.email')
            ->havingRaw('borrow_count > 0')
            ->orderBy('borrow_count', 'desc')
            ->take(5)
            ->get();

        return $query;
    }

    public function topLateReturners()
    {
        $currentDateTime = Carbon::now();

        $query = $this->model
            ->select('users.id', 'users.name','users.email' , \DB::raw('COUNT(borrows.id) as late_count'))
            ->leftJoin('borrows', 'users.id', '=', 'borrows.user_id')
            ->where(function ($query) use ($currentDateTime) {
                $query->whereNull('borrows.actual_return_date')
                    ->orWhere('borrows.actual_return_date', '>', $currentDateTime);
            })
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderBy('late_count', 'desc')
            ->take(5)
            ->get();

        return $query;
    }
}