<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\Author;

class AuthorEloquentRepository extends BaseEloquentRepository {
    public function model() {
        return Author::class;
    }

    public function filterAuthors($limit ,$sort_filter, $search) {
        $query = $this->model->select('authors.*');
    
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
                    $query = $query->orderBy('authors.created_at', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('authors.created_at', 'asc');
                    break;
                case 'a_z':
                    $query = $query->orderBy('authors.name', 'asc');
                    break;
                case 'z_a':
                    $query = $query->orderBy('authors.name', 'desc');
                    break;
                default:
                    break;
            }
        }
    
        $results = $query->paginate($limit);
    
        return $results;
    }
}
