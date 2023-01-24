@extends('admin.partials.admin_dashboard')
@section('admincontent')
	<h1 class="mt-4">Update "<em>{{$blog->blog_title}}</em>"</h1><hr>
	<div class="container">
		<div class="row">
			<div class="col-sm-10" style="margin:1rem auto;">
				<form action="/update_blog_admin/{{$blog->id}}" method="post" enctype="multipart/form-data">
					@csrf
					@method('put')
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="blog_title">Blog Title</label>
										<input type="text" name="blog_title" class="form-control" value="{{$blog->blog_title}}">
									</div>
								</div>
								<div class="col-sm-6">
									<label for="blog_intro">Blog Introduction</label>
									<input type="text" name="blog_intro" class="form-control" value="{{$blog->blog_introduction}}">
								</div>
							</div>
							<div class="form-group">
								<label for="blog_description">Blog Description</label>
								<textarea name="blog_description" id="blog_description" class="form-control">
									{{$blog->blog_description}}
								</textarea>
							</div>
							<div class="row mt-2">
								<div class="col-sm-8">
									<div class="form-group">
										<label for="blog_image">Blog Image</label>
										<input type="file" name="blog_image" class="form-control">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<img src="{{Storage::url($blog->blog_image)}}" alt="{{$blog->blog_title}}" style="width:250px;height:150px;float:right;">
									</div>
								</div>
							</div>			
						</div>
						<div class="card-footer">
							<div class="form-group">
								<button type="submit" class="btn btn-outline-dark" style="float:right">Update Blog</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection