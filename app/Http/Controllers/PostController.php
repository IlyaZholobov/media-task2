<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use App\Repository\PostRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    protected PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(Request $request): View
    {
        $filter = [
            'page' => (int)$request->query('page')
        ];

        $postsOnPage = $this->postRepository->getByFilter($filter);
        $totalCount = $this->postRepository->count();

        return view(
            'post.post', [
                'title' => 'Posts',
                'posts' => $postsOnPage,
                'totalCount' => $totalCount,
                'limitOnPage' => PostRepository::LIMIT_ON_PAGE
            ]
        );
    }
}
