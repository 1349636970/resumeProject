@extends("resume.common.layout")
@section("js/css")
    <link href="{{asset("css/froala_style.min.css")}}" rel="stylesheet" type="text/css" />
@stop
@section("content")
<div class="container mt-5">
        <div class="fr-view">
            @foreach($resume as $resumeShow)
                Job:{{$resumeShow->job}}<br>
                user:{{$username}}
            <br>
            <div style="text-align: center;margin-top: 100px;">
                {!! $resumeShow->resume !!}
            </div>
            @endforeach
        </div>
</div>
@stop