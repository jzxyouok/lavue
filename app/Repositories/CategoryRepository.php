<?php
/**
 * File: CategoryRepository.php
 * User: xieguoqiu
 * Date: 2016/9/30 16:00
 */

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends EloquentRepository
{
    
    /**
     * CategoryRepository constructor.
     * @param $category
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function all()
    {
        return $this->model
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function paginate($page = null, $pageSize = null)
    {
        return $this->model
            ->orderBy('id', 'DESC')
            ->forPage(getPage($page), getPageSize($pageSize))
            ->get();
    }

    public function getTotal()
    {
        return $this->model->count();
    }

    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function one($id)
    {
        return $this->model->find($id);
    }

    public function update($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }
    
}
