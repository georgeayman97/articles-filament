<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\Collection;
use App\Services\Categories\Index;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @param Index $index
     */
    public function __construct(protected Index $index)
    {
    }
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        $categories = $this->index->index();
        return new Collection($categories);
    }
}
