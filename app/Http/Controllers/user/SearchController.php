<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Repositories\Eloquent\AuthorEloquentRepository;

class SearchController extends Controller
{

    protected $productRepository;
    protected $categoryRepository;
    protected $authorRepository;

    public function __construct(
        ProductEloquentRepository $productRepository,
        CategoryEloquentRepository $categoryRepository,
        AuthorEloquentRepository $authorRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->authorRepository = $authorRepository;
    }

    public function index(Request $request) {

        

        $limit = $request -> limit ?? 20;
        $type = $request -> type ?? 'all';
        $sort = $request -> sort ?? 'latest';
        $search = $request -> search ?? null;
        $cate_list = $request -> categories ?? [];
        $author_list = $request -> authors ?? [];
        

        $products  = $this -> productRepository -> searchProducts($limit, $type, $sort, $search, $cate_list, $author_list);
        $products2 = $this -> productRepository -> searchProducts(1000, 'all', $sort, $search, $cate_list, $author_list);
        
        $categories = $this -> categoryRepository -> all();
        $authors = $this -> authorRepository -> all();
        
        return view('user.search', compact('products', 'categories', 'authors', 'products2'));
    }
}
