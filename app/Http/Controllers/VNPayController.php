<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\OrderEloquentRepository;

class VNPayController extends Controller
{
    private $vnp_TmnCode = "XABJ4V9B";
    private $vnp_HashSecret = "FVZEIBCVABUSOPPIFDRGFENOTRRKYSMT"; 
    private $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    private $vnp_Returnurl;
    private $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
    private $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
    private $startTime;
    private $expire ;

    protected $orderRepository;

    public function __construct(OrderEloquentRepository $orderRepository) {
        $this -> orderRepository = $orderRepository;
        $this -> vnp_Returnurl = route("vnp_return");
        $this -> startTime = date("YmdHis");
        $this -> expire = date('YmdHis',strtotime('+15 minutes',strtotime($this -> startTime)));
    }

    public function createPayment(Request $request) {
        $vnp_TxnRef = $request->session()->get('orderId'); //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $request->session()->get('amount'); // Số tiền thanh toán
        $vnp_Locale = $_POST['language'] ?? 'vn'; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = $_POST['bankCode'] ?? null; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'] ?? $request->ip(); //IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this -> vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount*100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $this -> vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$this -> expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $this -> vnp_Url = $this -> vnp_Url . "?" . $query;
        if (isset($this -> vnp_HashSecret)) {
            $this -> vnpSecureHash =   hash_hmac('sha512', $hashdata, $this -> vnp_HashSecret);//  
            $this -> vnp_Url .= 'vnp_SecureHash=' . $this -> vnpSecureHash;
        }

        if($vnp_Amount>0) 
            return redirect()->away($this->vnp_Url);
        else return redirect() -> route('cart');
    }

    public function Returnurl(Request $request) {
        
        $this -> orderRepository -> update(
            [
                'order_code' => $request -> vnp_TransactionNo,
                'payment_method' => "2",
                'payment_status' => "1"
            ]
        , $request -> vnp_TxnRef);
        return redirect() -> route('orderDetail', ['id' => $request -> vnp_TxnRef]);
    }


}
