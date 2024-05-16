<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    private $imageTypes = [
        'upload_image' => [
            'field' => "image",
            'imageSize' => [
                'width' => 760,
                'height' => null
            ],
            'filePath' => "app/public/uploads/image/"
        ],
        'upload_thumbnail' => [
            'field' => "thumbnail",
            'imageSize' => [
                'width' => 100,
                'height' => null
            ],
            'filePath' => "app/public/uploads/thumbnail/"
        ],
        
        
    ];

    public function upload(Request $request) {
        $images = [];
        if ($request->hasFile('upload_image')) {
            foreach($this -> imageTypes as $key =>  $imageType) {
                
                $filePath = storage_path($imageType['filePath']);
                if (!File::isDirectory($filePath)) {
                    File::makeDirectory($filePath, 0777, true, true);
                }

                // Sửa bảng và chỉnh sửa lại thêm sửa xóa theo theme mới
                // Sửa phần upload ảnh 


                $imageSize = $imageType['imageSize'];
            
                $newName = Str::random(20) . '.' . $request->file('upload_image')->getClientOriginalExtension();
                $img = Image::make($request->file('upload_image')->path());
                $img->resize($imageSize['width'], $imageSize['height'], function ($const) {
                    $const->aspectRatio();
                    $const->upsize();
                })->save($filePath . $newName);
            
                $imagePath = Storage::url("public/uploads/". $imageType['field']. "/" . $newName);
                $images += [$imageType['field'] => asset($imagePath)];
            
        }
    }
        return $images;
    }

    public function remove($url) {
        $path = storage_path('app/public/uploads/'.str_replace(url('storage/uploads'), '', $url));
        if (file_exists($path) && !is_dir($path)) {
            unlink($path);
        }
    }
}