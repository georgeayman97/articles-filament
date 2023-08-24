<?php

namespace App\Repositories\Authors;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface AuthorRepositoryInterface
{
    public function index(): Collection|LengthAwarePaginator;
    public function latest(): Collection;

}
