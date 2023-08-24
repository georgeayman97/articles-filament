<?php

namespace App\Http\Controllers\Api;

use App\DTO\ArticleDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Http\Responses\ErrorResponse;
use App\Services\Articles\Find;
use App\Services\Articles\Featured;
use App\Services\Articles\Index;
use App\Services\Articles\Store;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    /**
     * @param Index $index
     * @param Store $store
     * @param Find $find
     */
    public function __construct(protected Index $index, protected Store $store, protected Find $find)
    {
    }

    /**
     * @param $id
     * @return ArticleResource
     */
    public function find($id): ArticleResource
    {
        return new ArticleResource($this->find->find($id));
    }

    /**
     * @return ArticleCollection
     */
    public function index()
    {
        $articles = $this->index->index();
        return new ArticleCollection($articles);
    }

    /**
     * @param ArticleRequest $request
     * @return JsonResponse
     */
    public function store(ArticleRequest $request)
    {
        $articleDTO = new ArticleDTO($request->all());
        $createdArticle = $this->store->store($articleDTO);

        return response()->json(['data' => $createdArticle], Response::HTTP_CREATED);
    }
}





