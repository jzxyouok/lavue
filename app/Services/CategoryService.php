<?php
/**
 * File: CategoryService.php
 * User: xieguoqiu
 * Date: 2016/9/30 16:37
 */

namespace App\Services;

use App\Events\DeleteCategory;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryService
{

    protected $categoryRepository;

    /**
     * CategoryService constructor.
     * @param $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function add($data)
    {
        $this->validate($data);
        
        return $this->categoryRepository->create($data);
    }

    public function update($id, $data)
    {
        $this->validate($data, $id);
        
        $this->categoryRepository->updateById($id, $data);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        $this->categoryRepository->delete($id);
        event(new DeleteCategory($id));
        DB::commit();
    }

    protected function validate($data, $id = 0)
    {
        $validator = Validator::make($data, [
            'name' => 'required|min:2|unique:categories,id,' . $id
        ], [
            'name.required' => '请填写分类名称',
            'name.unique' => '分类名称已存在',
            'name.min' => '分类名称最少为2个字符'
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first(), 400);
        }
    }
    
}
