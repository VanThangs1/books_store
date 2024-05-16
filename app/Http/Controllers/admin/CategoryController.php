<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\ImageController;

use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Repositories\Eloquent\ProductEloquentRepository;

class CategoryController extends Controller
{

    protected $categoryRepository;

    public function __construct(
        CategoryEloquentRepository $categoryRepository,
        ProductEloquentRepository $productRepository
    ) {
        $this -> categoryRepository = $categoryRepository;
        $this -> productRepository = $productRepository;
    }

    public function index(Request $request) {
        
        $filters = $this -> handleFilter($request);
        if(count($filters) > 0) {
            $categories = $this -> categoryRepository -> filterCategories(
                $filters['limit'] ?? 5, 
                $filters['sort_filter'] ?? 'latest',
                $filters['search'] ?? null
            );
        }else {
            $categories  = $this -> categoryRepository -> paginateWhereOrderBy([], 'updated_at','DESC', $request -> page ?? 1, 5, ['*']);
        }
        $current_filters = $request -> all();
        return view('admin.categories.index', compact('categories', 'current_filters'));
    }

    public function createForm() {
        return view('admin.categories.create');
    }


    // Xử lý thêm danh mục
    public function handleCreate(Request $request, ImageController $img) {

        $validated = $request -> validate([
            'title' => 'required'
        ]);

        $request -> merge($img -> upload($request));  

        $data = $request -> merge(
            [
                'added_by' => auth('web') -> id(),
                'slug' => Str::slug($request -> title)
            ]
        ) -> all();

        $this -> categoryRepository -> create($data);

        return redirect() -> route('admin.categories') -> with(['success' => "Thêm thành công danh mục: ".$request -> title."!"]);
    }

    public function editForm(Request $request) {
        $foundCategory = $this -> categoryRepository -> findById($request -> id);
        return view('admin.categories.edit', compact('foundCategory'));
    }

    // Xử lý sửa danh mục
    public function handleEdit(Request $request, ImageController $img) {
        $validator = $request -> validate([
            'title' => 'required',
        ]);

        $foundCategory = $this -> categoryRepository -> findById($request -> id);

        $hasFileImage = $request -> hasFile('upload_image');
        $hasFileThumbnail = $request -> hasFile('upload_thumbnail');

        if($hasFileImage || isset($request -> is_delete)) {
            $img -> remove($foundCategory -> image);
        }
        if($hasFileThumbnail) {
            $img -> remove($foundCategory -> thumbnail);   
        }
        $request -> merge($img -> upload($request));

        if(isset($request -> is_delete)) {
            $request -> merge([
                'image' => '',
            ]);
        }

        $this -> categoryRepository -> update($request -> all(), $foundCategory -> id);

        return redirect() -> route('admin.category.edit', $foundCategory -> id) -> with('success', 'Updated Category');
    }

    public function handleDelete(Request $request, ImageController $img) {
        $id = $request -> id;
        $foundCategory = $this -> categoryRepository -> findById($id);
        $foundCategory -> delete();
        // $img -> remove($foundCategory -> image);
        // $productsDp = $this -> productRepository -> findWhere(['author_id' => $id], array('*'));
        // foreach($productsDp as $product) {
        //     $img -> remove($product -> image);
        // }
        // $this -> productRepository -> deleteWhere(['category_id' => $id]);
        // $this -> categoryRepository -> delete($id);
        
        return redirect() -> route('admin.categories') -> with('success', 'Xóa thành công danh mục '.$foundCategory -> title);
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
}
