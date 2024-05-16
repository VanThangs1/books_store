<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Eloquent\AuthorEloquentRepository;
use App\Repositories\Eloquent\ProductEloquentRepository;



class AuthorController extends Controller
{

    protected $authorRepository;
    protected $productRepository;

    public function __construct(
        AuthorEloquentRepository $authorRepository,
        ProductEloquentRepository $productRepository) {
        $this -> authorRepository = $authorRepository;
        $this -> productRepository = $productRepository;
    }


    public function index(Request $request) {
        $q = $request -> input('search');
        if(isset($q) && $q != '') {
            $authors  = $this -> authorRepository -> findWhere([['name', 'like', "%$q%"]]);
        }else {
            $authors  = $this -> authorRepository -> all();
        }

        return view('user.author', compact('authors', 'q'));
    }

    public function detail(Request $request) {
        if($request->slug) {
            $foundAuthor = $this -> authorRepository->findBySlug($request->slug);
        }else {
            $foundAuthor = '';
        }
        return view('user.author-detail', compact('foundAuthor'));
    }
}
