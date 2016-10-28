<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    
    protected $articleRepository;
    protected $articleService;

    public function __construct(ArticleRepository $articleRepository, ArticleService $articleService)
    {
        $this->articleRepository = $articleRepository;
        $this->articleService = $articleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = $this->articleRepository->paginate();

        $count = $this->articleRepository->getTotal();

        return $this->responsePagination($articles, $count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->articleService->add(
            $request->only(['title', 'category_id', 'summary', 'image', 'content'])
        );
        
        return successJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->articleRepository->find($id);
        return successJson($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->articleService->updateById($id, $request->only(['title', 'summary', 'image', 'category_id', 'content']));
        
        return successJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->articleRepository->delete($id);
    }

    public function switchStatus($id)
    {
        $article = $this->articleRepository->find($id, ['status']);

        $this->articleRepository->updateById($id, ['status' => $article->status ? 0 : 1]);

        return successJson();
    }
}
