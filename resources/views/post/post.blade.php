@extends('base')

@section('content')

    @if($totalCount)
        <div class="posts">
            @foreach($posts as $post)
                <div class="post">
                    <div class="post-title">
                        <p><strong>Title</strong> {{$post->title}}</p>
                    </div>
                    <div class="post-body">
                        <p>{{$post->body}}</p>
                    </div>
                    <div class="post-comments">
                        <st>Comments</st>
                        @foreach($post->comments as $comment)
                            <div class="comment">
                                {{ $comment->body }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="paginator">
            @include('post.paginator')
        </div>
    @else
        <p>Posts not exists</p>
    @endif
@endsection()