<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\Product;

class ProductEloquentRepository extends BaseEloquentRepository {
    public function model() {
        return Product::class;
    }

    public function filterProducts($limit ,$sort_filter, $search, $author_id, $cate_id) {
        $query = $this->model->select('products.*') -> where('type', '0');
        
        if ($search) {
            $query = $query->where(function($query) use ($search) {
                $query->orWhere('id',"like",  "%$search%")
                    ->orWhere("title", "like", "%$search%");
            });
        }

        if ($author_id) {
            $query = $query->where("author_id", $author_id);
        }

        if ($cate_id) {
            $query = $query->where("category_id", $cate_id);
        }
        
    
        if ($sort_filter) {
            switch ($sort_filter) {
                case 'latest':
                    $query = $query->orderBy('products.created_at', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('products.created_at', 'asc');
                    break;
                case 'price_asc':
                    $query = $query->orderBy('products.price', 'asc');
                    break;
                case 'price_desc':
                    $query = $query->orderBy('products.price', 'desc');
                    break;
                case 'a_z':
                    $query = $query->orderBy('products.title', 'asc');
                    break;
                case 'z_a':
                    $query = $query->orderBy('products.title', 'desc');
                    break;
                default:
                    break;
            }
        }
    
        $result = $query -> paginate($limit);
        return $result;
    }

    public function filterBorrowProducts($limit ,$sort_filter, $search, $author_id, $cate_id) {
        $query = $this->model->select('products.*') -> where('type', '1');
        
        if ($search) {
            $query = $query->where(function($query) use ($search) {
                $query->orWhere('id',"like",  "%$search%")
                    ->orWhere("title", "like", "%$search%");
            });
        }

        if ($author_id) {
            $query = $query->where("author_id", $author_id);
        }

        if ($cate_id) {
            $query = $query->where("category_id", $cate_id);
        }
        
    
        if ($sort_filter) {
            switch ($sort_filter) {
                case 'latest':
                    $query = $query->orderBy('products.created_at', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('products.created_at', 'asc');
                    break;
                case 'price_asc':
                    $query = $query->orderBy('products.price', 'asc');
                    break;
                case 'price_desc':
                    $query = $query->orderBy('products.price', 'desc');
                    break;
                case 'a_z':
                    $query = $query->orderBy('products.title', 'asc');
                    break;
                case 'z_a':
                    $query = $query->orderBy('products.title', 'desc');
                    break;
                default:
                    break;
            }
        }
    
        $result = $query -> paginate($limit);
        return $result;
    }

    public function searchProducts($limit, $type, $sort_filter, $search, $cate_list, $author_list) {
        $query = $this->model->select('products.*');

        if($type == 'sell') $query -> where('type', '0');
        else if($type == 'borrow') $query -> where('type', '1');
        
        
        if ($search) {
            $query = $query->where(function($query) use ($search) {
                $query->orWhere('id',"like",  "%$search%")
                    ->orWhere("title", "like", "%$search%");
            });
        }

        if (count($cate_list) > 0) {
            $query->where(function ($query) use ($cate_list) {
                foreach ($cate_list as $item) {
                    $query->orWhere("category_id", $item);
                }
            });
        }
        
        if (count($author_list) > 0) {
            $query->where(function ($query) use ($author_list) {
                foreach ($author_list as $item) {
                    $query->orWhere("author_id", $item);
                }
            });
        }
        
    
        if ($sort_filter) {
            switch ($sort_filter) {
                case 'latest':
                    $query = $query->orderBy('products.created_at', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('products.created_at', 'asc');
                    break;
                case 'price_asc':
                    $query = $query->orderBy('products.price', 'asc');
                    break;
                case 'price_desc':
                    $query = $query->orderBy('products.price', 'desc');
                    break;
                case 'a_z':
                    $query = $query->orderBy('products.title', 'asc');
                    break;
                case 'z_a':
                    $query = $query->orderBy('products.title', 'desc');
                    break;
                default:
                    break;
            }
        }
    
        $result = $query -> paginate($limit);
        return $result;
    }

    public function topProducts()
    {
        $query = $this->model
            ->select('products.id', 'products.title', \DB::raw('COUNT(borrows.id) as borrow_count'))
            ->leftJoin('borrows', 'products.id', '=', 'borrows.product_id')
            ->groupBy('products.id', 'products.title') 
            ->orderBy('borrow_count', 'desc')
            ->take(5)
            ->get();

        return $query;
    }

}