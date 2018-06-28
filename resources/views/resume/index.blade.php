@extends("resume.common.layout")
@section("js/css")
    <script src="{{ asset("js/index.js") }}"></script><link rel="stylesheet" href="{{ asset("css/index.css") }}">
@stop
@section("content")
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset("images/landscape1.jpg") }}" alt="landscape1">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset("images/landscape2.jpg") }}" alt="landscape2">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset("images/landscape3.jpg") }}" alt="landscape3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <script>
        carousel();
    </script>
    <p class="h1">
        The place where the dream started！
    </p>
    <div class="container">
        <div class="row">
            @foreach($resume as $resumeShow)
            <div class="col-sm-6">
                <a href="{{asset("article")}}" style="color: #000;text-decoration: none;">
                <img class="w-100" src="{{asset("images/m2017090810261812.jpg")}}" alt="photo">
                <?php date_default_timezone_set("America/Los_Angeles")?>{{date("Y-m-d H:i",strtotime($resumeShow->updated_at))}}
                </a>
            </div>
            @endforeach
        </div>
    </div>
@stop