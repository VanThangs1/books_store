<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

use App\Repositories\Eloquent\AuthorEloquentRepository;
use App\Repositories\Eloquent\ProductEloquentRepository;

class CartController extends Controller
{

    protected $authorRepository;
    protected $productRepository;

    public function __construct(
        AuthorEloquentRepository $authorRepository,
        ProductEloquentRepository $productRepository) {
        $this -> authorRepository = $authorRepository;
        $this -> productRepository = $productRepository;
    }


    public function index (Request $request) {
        if (!$request->session()->has('cart')) {
            $cart = [];
        } else {
            $cart = $request->session()->get('cart');
        }
        $productsInCart = [];
        foreach ($cart as $item) {
            
            $product = $this -> productRepository -> findById($item['productid']);
            if ($product) {
                $product->quantityInCart = $item['cart_quantity'];
                $productsInCart[] = $product;
            }
        } 
        $count = count($productsInCart);
        return view('user.cart', compact('productsInCart', 'count'));
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Kiểm tra xem giỏ hàng đã tồn tại hay chưa
        if (!$request->session()->has('cart')) {
            $cart = [];
        } else {
            $cart = $request->session()->get('cart');
        }

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
        $existingProduct = null;
        foreach ($cart as $key => $item) {
            if ($item['productid'] == $productId) {
                $existingProduct = $key;
                break;
            }
        }

        // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng
        if ($existingProduct !== null) {
            $cart[$existingProduct]['cart_quantity'] += $request->cart_quantity;
        } else {
            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới
            $cart[] = [
                'productid' => $productId,
                'cart_quantity' => $request->cart_quantity,
                'quantity' => $request->cart_quantity,
            ];
        }

        // Lưu lại giỏ hàng trong session
        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function updateOrder(Request $request)
    {
        if (count($request->all()) > 0) {
            $cart = $request->session()->get('cart');

            foreach ($cart as &$item) {
                $product = $this->findProduct($request->all(), $item['productid']);

                if ($product) {
                    $item['quantity'] = $product['quantity'];
                    $item['checked'] = 1;
                } else {
                    $item['checked'] = 0;
                }
            }
            
            $request->session()->put('cart', $cart);
            return response()->json(route('createOrder'));
        }

        return 0;
    }

    public function findProduct($cart, $productId)
    {
        foreach ($cart as $product) {
            if ($product['productId'] == $productId) {
                return $product;
            }
        }
        
        return null;
    }

    public function updateCartItem(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Kiểm tra xem giỏ hàng có tồn tại hay không
        if (!$request->session()->has('cart')) {
            return redirect()->back()->with('error', 'Giỏ hàng không tồn tại.');
        }

        $cart = $request->session()->get('cart');

        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $cart->updateProduct($product, $request->quantity);

        // Lưu lại giỏ hàng trong session
        $request->session()->put('cart', $cart);

        

        return redirect()->back()->with('success', 'Sản phẩm trong giỏ hàng đã được cập nhật.');
    }

    public function removeCartItem(Request $request, $productId)
    {
        // Kiểm tra xem giỏ hàng có tồn tại hay không
        if (!$request->session()->has('cart')) {
            return redirect()->back()->with('error', 'Giỏ hàng không tồn tại.');
        }

        $cart = $request->session()->get('cart');

        // Tìm vị trí sản phẩm trong giỏ hàng
        $productIndex = null;
        foreach ($cart as $key => $item) {
            if ($item['productid'] == $productId) {
                $productIndex = $key;
                break;
            }
        }

        // Nếu sản phẩm tồn tại trong giỏ hàng, xóa sản phẩm đó khỏi mảng giỏ hàng
        if ($productIndex !== null) {
            unset($cart[$productIndex]);
            // Cập nhật lại mảng giỏ hàng
            $cart = array_values($cart);
        }

        // Lưu lại giỏ hàng trong session
        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
}
