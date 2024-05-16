<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProxyController extends Controller
{
    public function getPdf(Request $request)
    {
        $pdfUrl = $request->query('url');

        // Kiểm tra xác thực hoặc các điều kiện khác nếu cần thiết

        // Gửi yêu cầu đến máy chủ chứa tài nguyên PDF
        $response = Http::get($pdfUrl);

        // Chuyển tiếp phản hồi từ máy chủ chứa tài nguyên PDF về trình duyệt
        return response($response->body(), $response->status())
            ->header('Content-Type', $response->header('Content-Type'));
    }
}
