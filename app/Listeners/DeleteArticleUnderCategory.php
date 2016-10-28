<?php

namespace App\Listeners;

use App\Events\DeleteCategory;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteArticleUnderCategory
{

    protected $articleRepository;

    /**
     * Create the event listener.
     * @param  ArticleRepository  $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Handle the event.
     *
     * @param  DeleteCategory  $event
     * @return void
     */
    public function handle(DeleteCategory $event)
    {
        $this->articleRepository->deleteByCategoryId($event->categoryId);
    }
}
