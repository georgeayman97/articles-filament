<?php

namespace App\Services\Categories;

use App\Repositories\Categories\CategoryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Index
{

    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
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
        return $this->categoryRepository->index(request()->paginate);
    }
}
