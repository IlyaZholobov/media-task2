@extends('base')

@section('content')

    @if($isPostsLoaded)
        <p>Новые посты с комментариями были загружены</p>
    @else
        <p>Посты закончились</p>
    @endif

@endsection()