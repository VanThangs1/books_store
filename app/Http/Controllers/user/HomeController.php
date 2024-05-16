<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Repositories\Eloquent\AuthorEloquentRepository;

class HomeController extends Controller
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

    function index() {
        $categories = $this-> categoryRepository -> whereLimit([], 'id', 'ASC', 10);
        $products = $this -> productRepository -> whereLimit(["type" => 2], 'id', 'ASC', 8);
        
        return view('user.index', compact('categories', 'products'));
    }
}
