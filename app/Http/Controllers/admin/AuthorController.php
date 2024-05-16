<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\ImageController;
use App\Repositories\Eloquent\AuthorEloquentRepository;
use App\Repositories\Eloquent\ProductEloquentRepository;

use Illuminate\Support\Str;

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
        $filters = $this -> handleFilter($request);
        if(count($filters) > 0) {
            $authors = $this -> authorRepository -> filterAuthors(
                $filters['limit'] ?? 5, 
                $filters['sort_filter'] ?? 'latest',
                $filters['search'] ?? null
            );
        }else {
            $authors  = $this -> authorRepository -> paginateWhereOrderBy([], 'updated_at','DESC', $request -> page ?? 1, 5, ['*']);
        }

        $current_filters = $request -> all();
        return view('admin.authors.index', compact('authors', 'current_filters'));
    }

    public function createForm() {
        return view('admin.authors.create');
    }

    public function handleCreate(Request $request, ImageController $img) {
        $validator = $request ->  validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:authors',
            'phone_number' => 'required|string|max:255|unique:authors'
        ]);

        $request -> merge($img -> upload($request)); 
        $data = $request -> merge([
            'slug' => Str::slug($request -> name),
            'added_by' => auth('web') -> id(),
        ]) -> all();

        $this -> authorRepository -> create($data);

        return redirect() -> route('admin.authors') -> with('success', 'Tạo thành công tác giả');

    }

    public function editForm(Request $request) {
        $foundAuthor = $this -> authorRepository -> findById($request-> id);
        return view('admin.authors.edit', compact('foundAuthor'));
    }

    public function handleEdit(Request $request, ImageController $img) {
        $validator = $request ->  validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:255'
        ]);
        $foundAuthor = $this -> authorRepository -> findById($request -> id);

        

        if(isset($request -> is_delete)) {
            $img -> remove($foundAuthor -> image);
            $request -> merge([
                'image' => ''
            ]);
        }

        $hasFileImage = $request -> hasFile('upload_image');
        $hasFileThumbnail = $request -> hasFile('upload_thumbnail');

        if($hasFileImage || isset($request -> is_delete)) {
            $img -> remove($foundAuthor -> image);
        }
        if($hasFileThumbnail) {
            $img -> remove($foundAuthor -> thumbnail);   
        }
        $request -> merge($img -> upload($request));
        $request -> merge([
            'slug' => Str::slug($request -> name),
        ]);

        if(isset($request -> is_delete)) {
            $request -> merge([
                'image' => '',
            ]);
        }

        $this -> authorRepository -> update($request -> all(), $foundAuthor -> id);

        return redirect() -> route('admin.author.edit', $foundAuthor -> id) -> with('success', 'Updated author');

    }

    public function handleDelete(Request $request, ImageController $img) {
        $id = $request -> id;
        $foundAuthor = $this -> authorRepository -> findById($id);
        $foundAuthor -> delete();
        // $img -> remove($foundAuthor -> image);
        // $productsDp = $this -> productRepository -> findWhere(['author_id' => $id], array('*'));
        // foreach($productsDp as $product) {
        //     $img -> remove($product -> image);
        // }
        // $this -> productRepository -> deleteWhere(['author_id' => $id]);
        // $this -> authorRepository -> delete($id);
        
        return redirect() -> route('admin.authors') -> with('success', 'Xóa thành công tác giả');
    }

    public function handleFilter(Request $request) {
        $filterOptions = [
            'limit',
            'sort_filter',
            'search'
        ];
        
        $filterValue = [];
        
        foreach ($filterOptions as $key => $value) {
            if ($request->has($value)) {
                $filterValue[$value] = $request->input($value);
            }
        }
        return $filterValue;
    }

    public function filterAuthors(Request $request) {
        $categories = $this -> authorRepository -> filterAuthors(
            $request -> sort_filter,
            $request -> status_filter,
            $request -> keyword,
        );
        return $categories;
    }
}
