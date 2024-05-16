<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Repositories\Eloquent\AuthorEloquentRepository;
use App\Repositories\Eloquent\BorrowEloquentRepository;
use Illuminate\Support\Facades\DB;
use App\Mail\BorrowNotiEmail;
use Mail;
use DateTime;

class BorrowController extends Controller
{

    protected $productRepository;
    protected $categoryRepository;
    protected $authorRepository;
    protected $borrowRepository;

    public function __construct(
        ProductEloquentRepository $productRepository,
        CategoryEloquentRepository $categoryRepository,
        AuthorEloquentRepository $authorRepository,
        BorrowEloquentRepository $borrowRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->authorRepository = $authorRepository;
        $this->borrowRepository = $borrowRepository;
    }


    public function index () {
        return view('user.borrow-order');
    }

    public function borrow (Request $request) {
        $slug = $request->slug;
        $foundProduct = $slug ? $this->productRepository->findBySlug($slug) : null;
        $branches = DB::table('branches') -> get();
        return view('user.borrow', compact('foundProduct', 'branches'));
    }

    public function submitBorrow(Request $request) {
        $borrows = $this -> borrowRepository -> findWhere(['product_id' => $request-> id, 'actual_return_date' => null]);

        // if(count($borrows) > 0) return redirect() -> back() -> withError('Error', 'Bạn đang mượn sách này!');
        
        $request -> merge([
            'user_id' => auth() -> guard('web') -> user() -> id,
            'product_id' => $request -> id,
            'branch_id' => $request -> branch
        ]);
        
        $this->borrowRepository -> create($request -> all());
        $email = auth() -> guard('web') -> user() -> email;

        $product = $this -> productRepository -> findById($request -> id);
        // Lấy ngày mượn và ngày trả từ request
        $borrow_date = $request->borrow_date;
        $return_date = $request->return_date;

        // Tạo đối tượng DateTime từ chuỗi ngày mượn
        $start_date = new DateTime($borrow_date);

        // Tạo đối tượng DateTime từ chuỗi ngày trả
        $end_date = new DateTime($return_date);

        // Tính toán sự chênh lệch giữa hai ngày
        $interval = $start_date->diff($end_date);

        // Lấy số ngày chênh lệch
        $total_days = $interval->days;
        Mail::to($email)->send(new BorrowNotiEmail($product -> title,$product -> price, $total_days, $borrow_date, $return_date));

        return redirect() -> route('borrow');
    }

    public function borrowDetail (Request $request) {
        return view('user.borrow-order-detail');
    }
}
