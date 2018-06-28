@extends("resume.common.layout")
@section("js/css")
    <link rel="stylesheet" href="{{ asset("css/register.css") }}"><script src="{{ asset("js/register.js") }}"></script>
@stop
@section("content")
    <form action="{{ asset("register") }}" class="row h-100 align-items-center justify-content-center" method="POST">
        @csrf
        <div class="container col-sm-auto">
            <p class="h2">
                Welcome to register!
            </p>
            <p class="h5">
                {{$error}}
            </p>
            <div class="form-group row">
                <label for="email" class="col-form-label col-sm-auto">Email</label>
                <input type="email" name="user_email" class="form-control col-sm-8" placeholder="Email">
            </div>
            <div class="form-group row">
                <label for="username" class="col-form-label col-sm-auto">Username</label>
                <input type="text" name="user_name" class="form-control col-sm-7" placeholder="Username">
            </div>
            <div class="form-group row">
                <label for="password" class="col-form-label col-sm-auto">Password</label>
                <input type="password" name="user_password" class="form-control col-sm-8" placeholder="Password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@stop