<?php

namespace App\Project\Http\Controller;


use App\Project\App\Support\FractalService;
use App\Project\Domain\Article\ArticleService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;

class SearchController
{


    /**
     * @var ArticleService
     */
    private $articleService;


    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @SWG\Response(
     *     response=200,
     *     description="Returns the article collection"
     * )
     * @SWG\Parameter(
     *     name="query",
     *     in="query",
     *     type="string",
     *     description="search query"
     * )
     * @SWG\Tag(name="search")
     */
    public function index(Request $request)
    {
        $resource = $this->articleService->searchArticle($request);

        return new JsonResponse($resource);

    }
}