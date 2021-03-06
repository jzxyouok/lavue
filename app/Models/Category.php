<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['parent_id','name'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }
}
