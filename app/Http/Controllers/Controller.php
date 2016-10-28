<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function responsePagination($data, $count)
    {
        return successJson(['list' => $data, 'count' =>$count]);
    }
    
    protected function responseAll($list)
    {
        return successJson(['list' => $list]);
    }
}
