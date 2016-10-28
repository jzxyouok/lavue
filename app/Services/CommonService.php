<?php
/**
 * File: CommonService.php
 * User: xieguoqiu
 * Date: 2016/9/18 16:34
 */

namespace App\Services;

use Auth;
use Exception;
use Illuminate\Http\UploadedFile;

class CommonService
{

    public function uploadImg(UploadedFile $file)
    {
        $folder_name = '/uploads/images/' . date('Ym') . date('d') . '/' . Auth::user()->id . '/';

        if (!$file->isValid()) {
            throw new Exception('文件上传出错', 400);
        }

        $allowed_extensions = ['png', 'jpg', 'gif'];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            throw new Exception('请选择这确的图片格式上传', 400);
        }
        
        $filename = $_SERVER['REQUEST_TIME'] . mt_rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
        $save_path = public_path($folder_name);
        if (!file_exists($save_path)) {
            mkdir($save_path, 0755, true);
        }

        $file->move($save_path, $filename);
        
        return $folder_name . $filename;
    }
    
}
