@extends('layouts.default')
@section('content')

    @if(session('message'))
        <div id="message_time" class="alert {{ session('alert') }} fw-bold text-center mb-3"><h5>{{ session('message') }}</h5></div>
    @endif

    <div class="card">
        <div class="card-header">
            <h2>{{ __('custom.latest_posts') }}</h2>
        </div>
        <div class="card-body">
            @forelse($posts as $post)
                <ul class="list-group mb-3">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <a href="{{ url('/posts/' . $post->slug) }}" class="text-decoration-none"><h2>{{ $post->title }}</h2></a>
                                </div>
                                <div class="row">
                                    @if (session('website_language') == 'en')
                                        <span>{{ $post->created_at->format('M d, Y \a\t h:i A') }}</span>
                                    @else
                                        <span>{{ $post->created_at->format('d/m/Y \l\ú\c H:i') }}</span>
                                    @endif
                                    <span>{{ __('custom.by') }} <a href="" class="text-decoration-none">{{ $post->author->name }}</a></span>
                                </div>
                            </div>
                            @if (Auth::check() && ($post->author_id === Auth::user()->id))
                                @if ($post->active === 0)
                                    <div class="col text-end">
                                        <a class="btn btn-light" href="{{ route('posts.edit', ['post' => $post->id]) }}" role="button">{{ __('custom.btn_edit_draft') }}</a>
                                    </div>
                                @else
                                    <div class="col text-end">
                                        <a class="btn btn-light" href="{{ route('posts.edit', ['post' => $post->id]) }}" role="button">{{ __('custom.btn_edit_post') }}</a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </li>
                    <li class="list-group-item">
                        {!! Str::limit($post->body, $limit = 1500, $end = '....... <a href='. url("/" . $post->slug). '>' . __('custom.read_more')  .'</a>') !!}
                    </li>
                </ul>
            @empty
                <span>{{ __('custom.message_home_no_post') }}</span>
            @endforelse
            {!! $posts->links('pagination::bootstrap-4') !!}
        </div>
    </div>
@stop
