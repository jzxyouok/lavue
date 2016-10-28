<?php

namespace App\Services;

use App\Repositories\ArticleRepository;
use Auth;

class ArticleService
{
    
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function add($data)
    {
        $data['gallery'] = $data['image'];
        unset($data['image']);
        $data['views'] = 0;
        $data['status'] = 1;
        $data['admin_id'] = Auth::user()->id;
        $data['last_user_id'] = 0;
        
        $this->articleRepository->add($data);
    }

    public function updateById($id, $data)
    {
        $data['gallery'] = $data['image'];
        unset($data['image']);
        $data['admin_id'] = Auth::user()->id;
        
        $this->articleRepository->updateById($id, $data);
    }

}
