@extends("resume.common.layout")
@section('js/css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css"><link rel="stylesheet" href="{{ asset("css/froala_editor.pkgd.min.css") }}"><link rel="stylesheet" href="{{ asset("css/froala_style.min.css") }}">
@stop
@section("content")
    {{--navigation bar--}}
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a href="#" class="navbar-brand">Yingzheng backstage</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mycollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mycollapse">
            <ul class="navbar-nav">
                <li class="navbar-item active"><a href="#" class="nav-link">Home</a></li>
                <li class="navbar-item"><a href="#" class="nav-link">User manager</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="navbar-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown">{{$useremail}}</a>

                    <div class="dropdown-menu" style="left: -70px;">
                        <a href="#" class="dropdown-item">Home</a>
                        <a href="#" class="dropdown-item">setting</a>
                        <a href="#" class="dropdown-item">personal page</a>
                    </div>
                </li>
                <li class="navbar-item"><a href="#" class="nav-link">logout</a></li>
            </ul>
        </div>
    </nav>
    {{--workspace--}}
    <div class="container">
        <p class="h2" style="color: #d83d3d;text-align: center;">
            @if(session('status'))
                {{session('status')}}
            @endif
            {{$error}}
        </p>
        {{--left side navbar--}}
        <div class="row">
            <div class="list-group col-sm-2 mt-3">
                <a href="{{ asset("admin") }}" class="list-group-item list-group-item-action">Add resume</a>
                <a href="{{ asset("admin/editor") }}" class="list-group-item list-group-item-action active">Edit resume</a>
                <a href="{{ asset("admin/delete") }}" class="list-group-item list-group-item-action">Delete resume</a>
                <a href="{{ asset("admin/check") }}" class="list-group-item list-group-item-action">Check resume</a>
            </div>
            {{--resume list--}}
            <div class="col-sm-10 mt-3 ">
                <table class="table table-striped table-dark table-hover">
                    <thead>
                    <tr>
                        <th scope="col">resume</th>
                        <th scope="col">Job</th>
                        <th scope="col">Updated time</th>
                        <th scope="col">Create time</th>
                    </tr>
                    </thead>
                    <tbody><?php $number = 0;?>
                    @foreach($resume as $resumeShow)
                    <tr onclick='location.href ="editor/workspace?createTime={{strtotime($resumeShow->created_at)}}"' style="cursor:pointer;">
                        <th scope="col">{{$number = $number + 1}}</th>
                        <td>{{$resumeShow->job}}</td>
                        <td><?php date_default_timezone_set('America/Los_Angeles'); ?>{{date("Y-m-d H:i",strtotime($resumeShow->updated_at))}}</td>
                        <td><?php date_default_timezone_set('America/Los_Angeles'); ?>{{date("Y-m-d H:i",strtotime($resumeShow->created_at))}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{--Editor--}}
            <div class="col-sm-10 mt-3 d-none">
                <form action="{{asset("admin")}}" METHOD="POST" id="resume">
                    @csrf
                    <textarea name="resume" id="resume" cols="30" rows="10" title="resume" form="resume"></textarea>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
                <script src="{{ asset("js/froala_editor.pkgd.min.js") }}"></script>
                <script> $(function() { $('textarea').froalaEditor({
                        imageUpload: false,
                        videoUpload: false,
                        fileUpload: false,
                        quickInsertButtons: ['table', 'ul', 'ol', 'hr']
                    }) }); </script>
            </div>
        </div>
    </div>
@stop
