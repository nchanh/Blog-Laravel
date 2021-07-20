@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="mt-3">
                <h2>{{ __('custom.published_posts') }} {{ __('custom.of') }} {{ $user->name }}</h2>
            </div>
        </div>
        <div class="card-body">
            @forelse($posts as $post)
                <ul class="list-group mb-3">
                    <li class="list-group-item py-4">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <a href="{{ url('/posts/' . $post->slug) }}" class="text-decoration-none"><h3>{{ $post->title }}</h3></a>
                                </div>
                                <div class="row">
                                    @if (session('website_language') == 'en')
                                        <span>{{ $post->created_at->format('M d, Y \a\t h:i A') }}</span>
                                    @else
                                        <span>{{ $post->created_at->format('d/m/Y \l\ú\c H:i') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col text-end">
                                <div class="col text-end">
                                    @if ($post->active === 0)
                                    <div class="col text-end">
                                        <a class="btn btn-secondary" href="{{ route('posts.edit', ['post' => $post->id]) }}" role="button">{{ __('custom.btn_edit_draft') }}</a>
                                    </div>
                                    @else
                                        <div class="col text-end">
                                            <a class="btn btn-light" href="{{ route('posts.edit', ['post' => $post->id]) }}" role="button">{{ __('custom.btn_edit_post') }}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        {!! Str::limit($post->body, $limit = 1500, $end = '....... <a href='. url("/posts/" . $post->slug). '>' . __('custom.read_more')  .'</a>') !!}
                    </li>
                </ul>
            @empty
                {{ __('custom.message_home_no_post') }}
            @endforelse
        </div>
    </div>
@stop
