<?php

namespace App\Repositories\Tags;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface TagRepositoryInterface
{
    public function index(): Collection|LengthAwarePaginator;
    public function latest(): Collection;

}
