<?php

namespace App\Repositories\Articles;

use App\DTO\ArticleDTO;
use App\Enums\ArticleStatus;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Repositories\Repository;
class ArticleRepository extends Repository implements ArticleRepositoryInterface
{
    /**
     * @param Article $model
     */
    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    /**
     * @param null $paginate
     * @return Collection|LengthAwarePaginator
     */
    public function index($paginate = null): Collection|LengthAwarePaginator
    {
        if ($paginate) {
            return $this->model->whereStatus(ArticleStatus::ACTIVE)->paginate($paginate);
        }
        return $this->model->whereStatus(ArticleStatus::ACTIVE)->get();
    }

    /**
     * @param ArticleDTO $articleDTO
     * @return Article
     */
    public function create(ArticleDTO $articleDTO): Model
    {
        $article = Article::create([
            'title' => $articleDTO->title,
            'slug' => $articleDTO->slug,
            'content' => $articleDTO->content,
            'status' => $articleDTO->status,
            'image' => $articleDTO->image,
            'video' => $articleDTO->video,
            'author_id' => $articleDTO->author_id,
        ]);
        $article->categories()->sync($articleDTO->categories);
        $article->tags()->sync($articleDTO->tags);
        return $article;
    }

}
