<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject as AuthenticatableUserContract;

class Admin extends Model implements Authenticatable, AuthenticatableUserContract
{
    use AuthenticableTrait;
    
    protected $fillable = ['username', 'password', 'status', 'login_times'];

    protected $hidden = ['password', 'remember_token', 'updated_at'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }



    public function getJWTIdentifier()
    {
        return $this->getKey(); // Eloquent model method
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
