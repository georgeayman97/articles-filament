<?php

namespace App\Services\Authors;

use App\Repositories\Authors\AuthorRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class IndexAuthorService
{

    /**
     * @param AuthorRepositoryInterface $authorRepository
     */
    public function __construct(protected AuthorRepositoryInterface $authorRepository)
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
        return $this->authorRepository->index(request()->paginate);
    }

    /**
     * @param int $value
     * @return Collection
     */
    public function latest(int $value = 5):Collection
    {
        return $this->authorRepository->latest($value);
    }
}
