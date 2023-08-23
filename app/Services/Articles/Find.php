<?php

namespace App\Services\Articles;

use App\Repositories\Articles\ArticleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Find
{

    /**
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(protected ArticleRepositoryInterface $articleRepository)
    {
    }

    /**
     * @param int $id
     * @return Model
     */
    public function find(int $id): Model
    {
        return $this->articleRepository->find($id);
    }
}
