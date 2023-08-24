<?php

namespace App\Repositories\Articles;

use App\DTO\ArticleDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ArticleRepositoryInterface
{
    public function find($id): Model;

    public function index(): Collection|LengthAwarePaginator;
    public function featured(): Collection|LengthAwarePaginator;

    public function create(ArticleDTO $articleDTO): Model;

}
