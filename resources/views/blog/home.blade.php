@extends('layouts.base')
@section('main')
@include('layouts.navigation')
	<div class="container my-5">
		<div class="row">
			@foreach ($blogs as $blog)
				<div class="col-sm-4 mb-4">
					<a href="/blog_detail/{{$blog->id}}" class="text-decoration-none">
						<div class="card h-100">
							@if ($blog->blog_status == 'PENDING')
								<div class="card-footer bg-warning text-center text-white">
									<strong>{{$blog->blog_status}}</strong>
								</div>
							@elseif($blog->blog_status == 'ACCEPTED')
								<div class="card-footer bg-success text-center text-white">
									<strong>{{$blog->blog_status}}</strong>
								</div>
							@else
								<div class="card-footer bg-danger text-center text-white">
									<strong>{{$blog->blog_status}}</strong>
								</div>
							@endif
							<img src="{{Storage::url($blog->blog_image)}}" class="card-img-top" alt="{{$blog->blog_title}}" style="height:250px;">
							<div class="card-body">
								<h4 class="card-title text-dark">{{$blog->blog_title}}</h4>
								
								<p class="card-text text-dark">{{$blog->blog_introduction}}</p>
							</div>
							<div class="card-footer bg-light">
								<img src="{{Storage::url(Auth::user()->user_image)}}" alt="{{Auth::user()->name}}" style="width:50px;height:50px;border-radius:50%;">
								<small class="text-muted">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</small>
								
								<p class="text-muted" style="float:right;margin-top:12px;">{{$blog->updated_at->diffForHumans()}}</p>
							</div>
						</div>
					</a>
				</div>				
			@endforeach
			{{ $blogs->links('pagination::bootstrap-5') }}
		</div>
	</div>
@endsection