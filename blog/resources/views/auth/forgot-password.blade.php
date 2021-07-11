@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Register</h2>
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
                <div class="form-group">
                    <button class="btn btn-primary">Send Password Reset Link</button>
                </div>
            </form>
        </div>
    </div>
@stop
