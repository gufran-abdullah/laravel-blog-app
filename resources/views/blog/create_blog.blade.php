@extends('layouts.base')
@section('main')
@include('layouts.navigation')
	<div class="container">
		<div class="row">
			<div class="col-sm-10" style="margin:1rem auto;">
				<form action="/create_blog" method="post" enctype="multipart/form-data">
					@csrf
					<div class="card">
						<div class="card-body">
							<h4 class="text-center text-warning">Create Blog</h4>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="blog_title">Blog Title</label>
										<input type="text" name="blog_title" class="form-control" value="{{old('blog_title')}}" autofocus>
                                        @if ($errors->has('blog_title'))
                                            <p class="text-danger">{{$errors->first('blog_title')}}</p>
                                        @endif
									</div>
								</div>
								<div class="col-sm-6">
									<label for="blog_intro">Blog Introduction</label>
									<input type="text" name="blog_intro" class="form-control" value="{{old('blog_intro')}}">
                                    @if ($errors->has('blog_intro'))
                                        <p class="text-danger">{{$errors->first('blog_intro')}}</p>
                                    @endif
								</div>
							</div>
							<div class="form-group">
								<label for="blog_description">Blog Description</label>
								<textarea name="blog_description" id="blog_description" class="form-control">{{old('blog_description')}}</textarea>
                                @if ($errors->has('blog_description'))
                                    <p class="text-danger">{{$errors->first('blog_description')}}</p>
                                @endif
							</div>
							<div class="form-group">
								<label for="blog_image">Blog Image</label>
								<input type="file" name="blog_image" class="form-control" value="{{old('blog_image')}}">
                                @if ($errors->has('blog_image'))
                                    <p class="text-danger">{{$errors->first('blog_image')}}</p>
                                @endif
							</div>
						</div>
						<div class="card-footer">
							<div class="form-group">
								<button type="submit" class="btn btn-outline-warning" style="float:right">Create Blog</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection