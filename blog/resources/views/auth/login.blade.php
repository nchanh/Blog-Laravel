@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Login</h2>
        </div>
        <div class="card-body p-5">
            <form action="{{ route('login.post') }}" method="post">
                @csrf
                @if(session('errors'))
                    <div class="alert alert-danger fw-bold mb-4">{{ session('errors')->first() }}</div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success fw-bold mb-4">{{ session('success') }}</div>
                @endif
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3 col-12">
                            <label>E-Mail Address</label>
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
                <div class="form-group mb-4">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3 col-12">
                            <label>Password</label>
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
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="rememberMe" id="rememberMe" value="{{ old('rememberMe') }}" >
                    <label class="form-check-label" for="rememberMe">
                        Remember Me
                    </label>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-1 col-12">
                            <button class="btn btn-primary">Login</button>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-12 d-flex align-items-center">
                            <a class="text-decoration-none" href="#">Forgot Your Password?</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
