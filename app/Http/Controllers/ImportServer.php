<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Repository\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImportServer extends Controller
{
    protected const POST_URL = 'https://dummyjson.com/posts';
    protected const COMMENT_URL = 'https://dummyjson.com/comments/post/';

    protected PostRepository $postRepository;


    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $postResponse = Http::get(
            self::POST_URL,
            [
                'limit' => PostRepository::LIMIT_ON_LOAD,
                'skip' => $this->postRepository->count(),
                'select' => Post::REQUIRED_FIELD
            ]
        )->json();

        $postList = $postResponse['posts'] ?? [];

        if ($postList) {
            /** @var int $postId */
            foreach ($postList as $postData) {
                $post = Post::factory()->create($postData);

                $commentResponse = Http::get(
                    self::COMMENT_URL . $post->getAttribute('id'),
                )->json();

                $commentsListForPost = array_map(
                    static function ($commentData) {
                        if (array_key_exists('postId', $commentData)){
                            $commentData['post_id'] = $commentData['postId'];
                        }

                        return array_intersect_key($commentData, Comment::REQUIRED_FIELD,);
                    },
                    $commentResponse['comments'] ?? []
                );

                Comment::factory()->createMany($commentsListForPost);
            }

        }

        return view('import.import',
            [
                'title' => 'Import new posts',
                'isPostsLoaded' => count($postList),
            ]
        );
    }
}
