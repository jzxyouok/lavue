<?php

namespace App\Http\Controllers\Admin;

use App\Services\CommonService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{

    protected $commonService;

    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }

    public function uploadImg(Request $request)
    {
        if (!$request->hasFile('file')) {
            return failJson('文件不能为空', 400);
        }

        $image = $this->commonService->uploadImg($request->file('file'));

        return successJson(['img_url' => getUploadImgUrl($image)]);
    }

}
