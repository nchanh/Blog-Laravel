@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="mt-3">
                <h2>{{ __('custom.profile') }} {{ __('custom.of') }} {{ $user->name }}</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-5">
                <ul class="list-group">
                    <li class="list-group-item">
                        @if (session('website_language') == 'en')
                            <span>Joined on {{$user->first()->created_at->format('M d,Y \a\t h:i a') }}</span>
                        @else
                            <span>Đã tham gia vào {{$user->first()->created_at->format('d/m/Y \l\ú\c H:i') }}</span>
                        @endif
                    </li>
                    @if(!$user->is_subscriber())
                        <li class="list-group-item">
                            <table class="user__profile__table">
                                <tr>
                                    <td>{{ __('custom.total_Posts') }}</td>
                                    <td>{{ $count_posts }}</td>
                                    @if ($count_posts)
                                        <td><a href="{{ route('user.all_posts', ['id' => $user->id ]) }}" class="text-decoration-none">{{ __('custom.show_all') }}</a></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>{{ __('custom.published_posts') }}</td>
                                    <td>{{ $count_posts_published }}</td>
                                    @if ($count_posts_published)
                                        <td><a href="{{  route('user.posts', ['id' => $user->id ]) }}" class="text-decoration-none">{{ __('custom.show_all') }}</a></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>{{ __('custom.published_in_draft') }}</td>
                                    <td>{{ $count_posts_drafted }}</td>
                                    @if ($count_posts_drafted)
                                        <td><a href="{{ route('user.drafts', ['id' => $user->id ]) }}" class="text-decoration-none">{{ __('custom.show_all') }}</a></td>
                                    @endif
                                </tr>
                            </table>
                        </li>
                    @endif
                    <li class="list-group-item">
                        <span>Total Comments 2</span>
                    </li>
                </ul>
            </div>
            @if(!$user->is_subscriber())
                <div class="card mb-5">
                    <div class="card-header">
                        <h4>{{ __('custom.latest_posts') }}</h4>
                    </div>
                    <div class="card-body">
                        @forelse($posts as $post)
                            <ul class="list-group mb-3">
                                <li class="list-group-item py-4">
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <a href="{{ url('/' . $post->slug) }}" class="text-decoration-none"><h3>{{ $post->title }}</h3></a>
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
                                                <a class="btn btn-light" href="{{ url('/edit/' . $post->slug) }}" role="button">{{ __('custom.btn_edit_post') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    {!! Str::limit($post->body, $limit = 1500, $end = '....... <a href='. url("/" . $post->slug). '>' . __('custom.read_more')  .'</a>') !!}
                                </li>
                            </ul>
                        @empty
                            {{ __('custom.message_home_no_post') }}
                        @endforelse
                    </div>
                </div>
            @endif
            <div class="card mb-5">
                <div class="card-header">
                    <h4>Latest Comments</h4>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row p-1">
                            <span>Comment</span>
                        </div>
                        <div class="row p-1">
                            <span>On time</span>
                        </div>
                        <div class="row p-1">
                            <span>On post <a href="" class="text-decoration-none">post</a> </span>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row p-1">
                            <span>Comment</span>
                        </div>
                        <div class="row p-1">
                            <span>On time</span>
                        </div>
                        <div class="row p-1">
                            <span>On post <a href="" class="text-decoration-none">post</a> </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@stop
