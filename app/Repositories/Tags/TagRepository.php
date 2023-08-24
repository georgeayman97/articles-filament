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
        $query = $this->model->whereStatus(ArticleStatus::ACTIVE);

        return $paginate ? $query->paginate($paginate) : $query->get();
    }

    /**
     * @param int $value
     * @return Collection
     */
    public function latest(int $value = 5): Collection
    {
        return $this->model->whereStatus(ArticleStatus::ACTIVE)->latest()->limit($value)->get();
    }
}
