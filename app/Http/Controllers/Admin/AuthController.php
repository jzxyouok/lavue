<?php

namespace App\Http\Controllers\Admin;

use App\Services\AdminService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    protected $adminService;

    /**
     * AuthController constructor.
     * @param $adminService
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        if ($this->adminService->check()) {
            return redirect('admin/index');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        if ($this->adminService->login($request->get('username'), $request->get('password'))) {
            return successJson($this->adminService->getUser());
        } else {
            return failJson('帐号或密码错误', 401);
        }
    }

    public function logout()
    {
        $this->adminService->logout();
        
        return redirect('admin/');
    }

}
