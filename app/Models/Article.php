<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'category_id',
        'admin_id',
        'title',
        'summary',
        'gallery',
        'content',
        'last_user_id',
        'views',
        'status'
    ];

    protected $hidden = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
