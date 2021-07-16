@extends('layouts.default')
@section('content')
    <script src="https://cdn.tiny.cloud/1/8yh4erf9pp8xtwujj4dr0a74qw175kqbmj4efgjax4yziqab/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'#body'});</script>
    <script type="text/javascript">
        tinymce.init({
            selector : "textarea",
            plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
            toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>

    <div class="card">
        <div class="card-header">
            <div>
                <h2>{{ __('custom.update_post') }}</h2>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('post.update') }}" method="post">
                @csrf
                @if(session('message'))
                    <div class="alert {{ session('alert') }} fw-bold mb-4">{{ session('message') }}</div>
                @endif
                <input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="title" value="@if(!old('title')) {{$post->title}}@endif{{ old('title') }}" placeholder="{{ __('custom.form_enter_title') }}" required>
                    @if ($errors->has('title'))
                        <div class="mt-2">
                            <span class="text-danger fst-italic">{{ $errors->first('title') }}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <textarea class="form-control" name="body" id="body" aria-hidden="true">
                        @if(!old('body'))
                            {!! $post->body !!}
                        @endif
                        {!! old('body') !!}
                    </textarea>
                    @if ($errors->has('body'))
                        <div class="mt-2">
                            <span class="text-danger fst-italic">{{ $errors->first('body') }}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    @if($post->active === 1)
                        <input type="submit" name='publish' class="btn btn-success" value="{{ __('custom.btn_update') }}"/>
                    @else
                        <input type="submit" name='publish' class="btn btn-success" value="{{ __('custom.btn_publish') }}"/>
                    @endif
                    <input type="submit" name="save" class="btn btn-outline-secondary" value="{{ __('custom.btn_save_as_draft') }}">
                    <span data-bs-toggle="modal" data-bs-target="#messageModal" class="btn btn-danger">{{ __('custom.btn_delete') }}</span>
                </div>
            </form>
        </div>
    </div>
    <script>
        function submitModal() {
            window.location.href = '/delete/{{ $post->id .'?_token=' . csrf_token()}}';
        }
    </script>
@stop
