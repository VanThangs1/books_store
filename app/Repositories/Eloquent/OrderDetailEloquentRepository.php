<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\OrderDetail;

class OrderDetailEloquentRepository extends BaseEloquentRepository {
    public function model() {
        return OrderDetail::class;
    }

    // public find
}