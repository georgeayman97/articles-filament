<?php

namespace App\Services\Articles;

use App\Repositories\Articles\ArticleRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Featured
{

    /**
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(protected ArticleRepositoryInterface $articleRepository)
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
        return $this->articleRepository->featured(request()->paginate);
    }
}