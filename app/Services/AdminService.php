<?php
/**
 * File: AdminService.php
 * User: xieguoqiu
 * Date: 2016/7/12 14:28
 */

namespace App\Services;

use App\Events\AdminLogin;
use App\Models\Admin;
use App\Repositories\AdminRepository;
use Auth;

class AdminService
{
    
    protected $adminRepository;

    /**
     * AdminService constructor.
     * @param $adminRepository
     */
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function login($username, $password)
    {
        $data = [
            'username' => $username,
            'password' => $password,
        ];

//        if (Auth::guard('admin')->attempt($data)) {
        if ($token = Auth::guard('admin')->attempt($data)) {
            
            $admin = Auth::guard('admin')->user(['id']);
            $admin['token'] = $token;

            event(new AdminLogin($admin));

            return true;
        } else {
            $admin = new Admin(['id' => 0,'username' => $username]);

            event(new AdminLogin($admin));

            return false;
        }
    }

    public function getUser()
    {
        return Auth::guard('admin')->user();
    }

    public function check()
    {
        return Auth::guard('admin')->check();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
    }

    public function update($id, $data)
    {
        if (Auth::guard('admin')->attempt(['username' => $data['username'], 'password' => $data['password']])) {
            $data['password'] = bcrypt($data['new_password']);
            unset($data['new_password']);
            $this->adminRepository->updateById($id, $data);
        } else {
            throw new \Exception('帐号或密码错误', 402);
        }
    }

}
 