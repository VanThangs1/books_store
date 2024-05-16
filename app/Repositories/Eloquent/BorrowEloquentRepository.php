<?php
namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use App\Repositories\BaseEloquentRepository;
use App\Models\Borrow;

class BorrowEloquentRepository extends BaseEloquentRepository {
    public function model() {
        return Borrow::class;
    }

    public function filterBorrows($limit ,$sort_filter, $id, $time_filter, $type, $user_id) {
        $query = $this->model->select('borrows.*');
    
        if ($id) {
            $query = $query->where('id', $id);
        }

        if($user_id) {
            $query = $query->where('user_id', $user_id);
        }

        if ($type) {
            switch ($type) {
                case 'borrowing':
                    $query = $query->whereNull('actual_return_date');
                    break;
                case 'borrowed':
                    $query = $query->whereNotNull('actual_return_date');
                    break;
                case 'all':
                    break;
                default:
                    break;
            }
        }
    
        if ($time_filter) {
            switch ($time_filter) {
                case 'all':
                    break;
                case 'day':
                    $query = $query->whereDate('borrow_date', today());
                    break;
                case 'week':
                    $query = $query->whereBetween('borrow_date', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query = $query->whereMonth('borrow_date', now()->month);
                    break;
                case 'year':
                    $query = $query->whereYear('borrow_date', now()->year);
                    break;
                default:
                    break;
            }
        }
    
        if ($sort_filter) {
            switch ($sort_filter) {
                case 'latest':
                    $query = $query->orderBy('borrows.borrow_date', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('borrows.borrow_date', 'asc');
                    break;
                default:
                    break;
            }
        }
    
        $results = $query->paginate($limit);
    
        return $results;
    }
}