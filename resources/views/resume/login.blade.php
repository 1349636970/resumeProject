@extends("resume.common.layout")
@section("js/css")
    <link rel="stylesheet" href="{{ asset("css/login.css") }}"><script src="{{ asset("js/login.js") }}"></script>
@stop
@section("content")
    <form action="{{ asset("login") }}" class="row h-100 align-items-center justify-content-center" method="POST">
        @csrf
        <div class="container col-sm-auto">
            <p class="h2">
                Welcome to login!
            </p>
            <p class="h5">
                {{$error}}
            </p>
            <div class="form-group row">
                <label for="email" class="col-form-label col-auto">Email</label>
                <input type="email" class="form-control col-sm-8" placeholder="Email" name="user_email">
            </div>
            <div class="form-group row">
                <label for="password" class="col-form-label col-auto">Password</label>
                <input type="password" class="form-control col-sm-8" placeholder="Password" name="user_password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@stop