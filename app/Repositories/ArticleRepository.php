<?php
/**
 * File: ArticleRepository.php
 * User: xieguoqiu
 * Date: 2016/9/13 15:53
 */

namespace App\Repositories;

use App\Models\Article;
use Request;

class ArticleRepository extends EloquentRepository
{
    
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function paginate($page = null, $pageSize = null)
    {
        return $this->model
            ->with(['admin' => function($query) {
                $query->select(['id', 'username']);
            }, 'category' => function($query) {
                $query->select(['id', 'name']);
            }])
            ->orderBy('id', 'DESC')
            ->forPage(getPage($page), getPageSize($pageSize))
            ->get();
    }

    public function getTotal()
    {
        return $this->model->count();
    }

    public function find($id, $field = ['*'])
    {
        return $this->model->find($id, $field);
    }

    public function updateById($id, $data)
    {
        $this->model->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
    }

    public function deleteByCategoryId($categoryId)
    {
        $this->model->where('category_id', $categoryId)->delete();
    }

    public function add($data)
    {
        $this->model->create($data);
    }

}
