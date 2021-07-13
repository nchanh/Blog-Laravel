@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ __('custom.register') }}</h2>
        </div>
        <div class="card-body p-5">
            <form action="{{ route('register.post') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3 col-12">
                            <label>{{ __('custom.name') }}</label>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-12">
                            <input type="text" class="form-control" name="name" id="name"  value="{{ old('name') }}" required/>
                            @if ($errors->has('name'))
                                <div class="mt-2">
                                    <span class="text-danger fst-italic">{{ $errors->first('name') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3 col-12">
                            <label>{{ __('custom.email_address') }}</label>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-12">
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required/>
                            @if ($errors->has('email'))
                                <div class="mt-2">
                                    <span class="text-danger fst-italic">{{ $errors->first('email') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3 col-12">
                            <label>{{ __('custom.password') }}</label>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-12">
                            <input type="password" class="form-control" name="password" id="password" maxlength="60" required/>
                            @if ($errors->has('password'))
                                <div class="mt-2">
                                    <span class="text-danger fst-italic">{{ $errors->first('password') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3 col-12">
                            <label>{{ __('custom.confirm_password') }}</label>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-12">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" maxlength="60" required/>
                            @if ($errors->has('password_confirmation'))
                                <div class="mt-2">
                                    <span class="text-danger fst-italic">{{ $errors->first('password_confirmation') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">{{ __('custom.register') }}</button>
                </div>
            </form>
        </div>
    </div>
@stop
