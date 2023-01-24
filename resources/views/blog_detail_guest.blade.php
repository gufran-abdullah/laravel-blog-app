@extends('layouts.base')
@section('main')
	<div class="container">
		<div class="row">
			<div class="col-sm-8" style="margin:5rem auto;">
				<h1>{{$blog->blog_title}}</h1>
				<small>Published - {{$blog->updated_at->diffForHumans()}}	<i class="fa fa-dot-circle-o"></i> {{$words_count}}</small><hr>
				<img src="{{Storage::url($blog->blog_image)}}" alt="{{$blog->blog_title}}" style="width:100%;height:auto;">
				<p class="text-wrap">
					{!! $blog->blog_description !!}
				</p>
				<div class="card mb-5">
					<div class="card-body">
						<div class="container">
							<div class="d-flex">
								<img src="{{Storage::url($blog->users->user_image)}}" alt="{{($blog->users->name)}}" style="width:120px;height:120px;border-radius:50%;">
								<p style="margin-top:50px;margin-left:10px;"><em>{{($blog->users->first_name)}} {{($blog->users->last_name)}}</em></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>					
	</div>
@endsection