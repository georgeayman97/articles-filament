<?php

namespace App\Repositories\Categories;

use App\Enums\ArticleStatus;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @param Category $model
     */
    public function __construct(protected Category $model)
    {
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

    public function homeIndex(): Collection
    {
        return $this->model->whereStatus(ArticleStatus::ACTIVE)->latest()->limit(3)
            ->with('articles', fn($query) => $query->whereStatus(ArticleStatus::ACTIVE)->latest()->limit(5))->get();
    }
}
