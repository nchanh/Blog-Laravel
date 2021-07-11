@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Login</h2>
        </div>
        <div class="card-body p-5">
            <form action="" method="post">
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3 col-12">
                            <label>E-Mail Address</label>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-12">
                            <input type="email" class="form-control" name="email" id="email" required/>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3 col-12">
                            <label>Password</label>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-12">
                            <input type="password" class="form-control" name="password" id="password" required/>
                        </div>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
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
