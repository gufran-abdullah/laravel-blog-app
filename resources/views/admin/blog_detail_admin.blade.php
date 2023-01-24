@extends('admin.partials.admin_dashboard')
@section('admincontent')
    <div class="container">
        <h1 class="mt-4 text-center">{{$blogDetail->blog_title}}</h1><hr>
        <img src="{{Storage::url($blogDetail->blog_image)}}" alt="{{$blogDetail->blog_title}}" style="width:100%;height:auto;">
        <p>
            {!! $blogDetail->blog_description !!}
        </p>
        <div class="card mb-3">
            <div class="card-body">
                <div class="container">
                    <div class="d-flex">
                        <img src="{{Storage::url($blogDetail->users->user_image)}}" alt="{{($blogDetail->users->name)}}" style="width:120px;height:120px;border-radius:50%;">
                        <p style="margin-top:50px;margin-left:10px;"><em>{{($blogDetail->users->first_name)}} {{($blogDetail->users->last_name)}}</em></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection