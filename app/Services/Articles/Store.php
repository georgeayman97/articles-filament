<?php

namespace App\Services\Articles;

use App\DTO\ArticleDTO;
use App\Repositories\Articles\ArticleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Store
{

    /**
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(protected ArticleRepositoryInterface $articleRepository)
    {
    }

    /**
     * @param ArticleDTO $articleDTO
     * @return Model
     */
    public function store(ArticleDTO $articleDTO): Model
    {
        return $this->articleRepository->create($articleDTO);
    }
}
