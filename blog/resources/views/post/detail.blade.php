@extends('layouts.default')
@section('content')
    @if(session('message'))
        <div id="message_time" class="alert {{ session('alert') }} fw-bold text-center mb-3"><h5>{{ session('message') }}</h5></div>
    @endif
    <div class="card">
        <div class="card-header">
            <div>
                <h2 class="fw-bold">{{ $post->title }}</h2>
            </div>
            <div>
                @if (session('website_language') == 'en')
                    <span>{{ $post->created_at->format('M d, Y \a\t h:i A') }}</span>
                @else
                    <span>{{ $post->created_at->format('d/m/Y \l\ú\c H:i') }}</span>
                @endif
                <span>{{ __('custom.by') }} <a href="" class="text-decoration-none">{{ $post->author->name }}</a></span>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3">
                {!! $post->body !!}
            </div>
            <div>
                <h3 class="fw-bold">{{ __('custom.leave_a_comment') }}</h3>
            </div>
            <div class="card-body">
                <form action="" class="mb-5" method="post">
                    <textarea class="form-control mb-3" name="comment" placeholder="{{ __('custom.form_enter_comment') }}" required="required"></textarea>
                    <input type="submit" name="post_comment" class="btn btn-success" value="{{ __('custom.btn_post') }}">
                </form>
                <div>
                    <ul class="list-group mb-4">
                        <li class="list-group-item">
                            <div>
                                <h4>create by</h4>
                            </div>
                            <div>
                                <span>time</span>
                            </div>
                        </li>
                        <li class="list-group-item">A second item</li>
                    </ul>
                    <ul class="list-group mb-4">
                        <li class="list-group-item">
                            <div>
                                <h4>create by</h4>
                            </div>
                            <div>
                                <span>time</span>
                            </div>
                        </li>
                        <li class="list-group-item">A second item</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
