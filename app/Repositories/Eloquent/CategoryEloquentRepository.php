<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\Category;

class CategoryEloquentRepository extends BaseEloquentRepository {
    public function model() {
        return Category::class;
    }

    public function filterCategories($limit ,$sort_filter, $search) {
        $query = $this->model->select('categories.*');
    
        if ($search) {
            $query = $query->where(function($query) use ($search) {
                $query->orWhere('id',"like",  "%$search%")
                    ->orWhere("title", "like", "%$search%");
            });
        }
    
        if ($sort_filter) {
            switch ($sort_filter) {
                case 'latest':
                    $query = $query->orderBy('categories.created_at', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('categories.created_at', 'asc');
                    break;
                case 'a_z':
                    $query = $query->orderBy('categories.title', 'asc');
                    break;
                case 'z_a':
                    $query = $query->orderBy('categories.title', 'desc');
                    break;
                default:
                    break;
            }
        }
    
        $results = $query->paginate($limit);
    
        return $results;
    }
}