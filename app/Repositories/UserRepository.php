<?php
/**
 * File: UserRepository.php
 * User: xieguoqiu
 * Date: 2016/9/12 15:12
 */

namespace App\Repositories;

use App\User;

class UserRepository extends EloquentRepository
{
    

    public function __construct(User $user)
    {
        $this->model = $user;
    }
    
    
    
}
