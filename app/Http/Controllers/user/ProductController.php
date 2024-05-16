<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Repositories\Eloquent\AuthorEloquentRepository;
use Spatie\PdfToImage\Pdf;
use Image;

class ProductController extends Controller
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

    public function detail(Request $request)
    {
        $slug = $request->slug;
        $foundProduct = $slug ? $this->productRepository->findBySlug($slug) : null;

        return view('user.product-detail', compact('foundProduct'));
    }

    public function readbook(Request $request)
    {    
        $pdfUrl = 'http://localhost:8000/storage/uploads/pdf_file/Ngoi-khoc-tren-cay.pdf';

        return response() -> make('', 302)->header('Location', $pdfUrl)->header('Content-Type', '');
    }
}
