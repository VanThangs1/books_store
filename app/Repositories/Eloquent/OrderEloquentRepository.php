<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\Order;

class OrderEloquentRepository extends BaseEloquentRepository {
    public function model() {
        return Order::class;
    }

    public function filterOrders($sort_filter, $status, $id) {
        $query = $this->model->select('orders.*');
    
        if ($status == 0 || $status == 1 || $status == 2) {
            $query = $query->where('orders.order_status', $status);
        }
    
        if ($id) {
            $query = $query->where("id","=", "$id");
        }
    
        if ($sort_filter) {
            switch ($sort_filter) {
                case 'latest':
                    $query = $query->orderBy('orders.created_at', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('orders.created_at', 'asc');
                    break;
                default:
                    break;
            }
        }
        return $query->get();
    }
}