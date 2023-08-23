<?php

namespace App\Repositories\Categories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function index(): Collection|LengthAwarePaginator;

}
