<?php
/**
 * File: EloquentRepository.php
 * User: xieguoqiu
 * Date: 2016/9/30 17:42
 */

namespace App\Repositories;

class EloquentRepository
{

    /**
     * @var \Illuminate\Database\Eloquent\Model $model
     */
    protected $model;

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

    public function create($data)
    {
        $this->model->create($data);
    }

}
