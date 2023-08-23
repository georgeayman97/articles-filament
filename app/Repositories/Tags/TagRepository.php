<?php

namespace App\Repositories\Tags;

use App\Enums\ArticleStatus;
use App\Models\Tag;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TagRepository implements TagRepositoryInterface
{
    /**
     * @param Tag $model
     */
    public function __construct(protected Tag $model)
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
}
