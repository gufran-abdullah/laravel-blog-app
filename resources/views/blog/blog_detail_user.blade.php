@extends('layouts.base')
@section('main')
@include('layouts.navigation')
<div class="container">
    <div class="row">
        <div class="col-sm-8" style="margin:0 auto;">
            <h1 class="mt-4 text-center">{{$blog->blog_title}}</h1>
            <hr>
            <img src="{{Storage::url($blog->blog_image)}}" alt="{{$blog->blog_title}}" style="width:100%;height:auto;">
            <p>
                {!! $blog->blog_description !!}
            </p>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="container">
                        <div class="d-flex">
                            <img src="{{Storage::url($blog->users->user_image)}}" alt="{{($blog->users->name)}}"
                                style="width:120px;height:120px;border-radius:50%;">
                            <p style="margin-top:50px;margin-left:10px;"><em>{{($blog->users->first_name)}}
                                    {{($blog->users->last_name)}}</em></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection