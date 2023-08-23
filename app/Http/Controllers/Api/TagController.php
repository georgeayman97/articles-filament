<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tags\Collection;
use App\Services\Tags\Index;
use Illuminate\Http\Request;

class TagController extends Controller
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
        $tags = $this->index->index();
        return new Collection($tags);
    }
}
