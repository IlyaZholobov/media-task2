<?php

namespace App\Repository;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\JoinClause;

class PostRepository implements PostRepositoryInterface
{
    public const LIMIT_ON_PAGE = 25;
    public const LIMIT_ON_LOAD = 10;
    public const COMMENT_LIMIT = 3;

    public function count(): int
    {
        return Post::query()->count();
    }

    public function getByFilter(array $filter): Collection|array
    {
        $col = $filter['col'] ?? 'posts.id';
        $order = $filter['order'] ?? 'desc';
        $limit = $filter['limit'] ?? self::LIMIT_ON_PAGE;
        $skip = (int)($filter['page'] ?? null) * self::LIMIT_ON_PAGE;

        return Post::query()
//            ->leftJoin('comments',function (JoinClause $joinClause) {
//                $joinClause->on('posts.id', '=', 'comments.post_id')
//                    ->limit(self::COMMENT_LIMIT);
//            })
            ->orderBy($col, $order)
            ->skip($skip)
            ->limit($limit)
            ->get();
    }
}
