<?php
/**
 * File: AdminRepository.php
 * User: xieguoqiu
 * Date: 2016/11/11 15:38
 */

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository extends EloquentRepository
{

    public function __construct(Admin $admin)
    {
        $this->model = $admin;
    }

}
