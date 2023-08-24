<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\Authors\AuthorCollection;
use App\Http\Resources\Categories\CategoryCollection;
use App\Http\Resources\Tags\TagCollection;
use App\Services\Articles\Featured;
use App\Services\Authors\IndexAuthorService;
use App\Services\Categories\HomeIndex;
use App\Services\Tags\Index;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @param Featured $featured
     * @param HomeIndex $latestCategoriesHome
     * @param Index $tag
     * @param IndexAuthorService $author
     */
    public function __construct(protected Featured $featured, protected HomeIndex $latestCategoriesHome, protected Index $tag, protected IndexAuthorService $author)
    {
    }

    public function index()
    {
        $featuredArticles = $this->featured->index();
        $latestArticles  = $this->latestCategoriesHome->index();
        $latestTags = $this->tag->latest();
        $latestAuthors = $this->author->latest();
        return response()->json([
            'data' => [
                'featured_articles' => new ArticleCollection($featuredArticles),
                'latest_articles' => new CategoryCollection($latestArticles),
                'tags' => new TagCollection($latestTags),
                'authors' => new AuthorCollection($latestAuthors),
            ]
        ], Response::HTTP_OK);
    }
}
