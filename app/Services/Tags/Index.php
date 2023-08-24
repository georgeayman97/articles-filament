<?php

namespace App\Services\Tags;

use App\Repositories\Tags\TagRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Index
{

    /**
     * @param TagRepositoryInterface $tagRepository
     */
    public function __construct(protected TagRepositoryInterface $tagRepository)
    {
    }

    /**
     * @return Collection|LengthAwarePaginator
     */
    public function index(): Collection|LengthAwarePaginator
    {
        request()->validate([
            'paginate' => 'nullable|integer'
        ]);
        return $this->tagRepository->index(request()->paginate);
    }

    /**
     * @param int $value
     * @return Collection
     */
    public function latest(int $value = 5): Collection
    {
        return $this->tagRepository->latest($value);
    }
}
