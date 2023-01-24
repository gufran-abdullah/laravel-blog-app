@extends('layouts.base')
@section('main')
	<div class="container">
		<div class="row">
			<div class="col-sm-4" style="margin:10rem auto;">
				<div class="card">
					<form action="/register" method="post" enctype="multipart/form-data">
						@csrf
						<div class="card-body">
							<div class="d-flex">
								<a href="/login" class="text-warning"><i class="fa fa-arrow-left-long"></i>Back</a>
								<h4 class="text-center text-warning" style="margin-left:100px;">Register Here</h4>
							</div>
							<div class="form-group">
								<label for="name">Username</label>
								<input type="text" name="name" class="form-control" value="{{old('name')}}" autofocus>
								@if ($errors->has('name'))
									<p class="text-danger">{{$errors->first('name')}}</p>
								@endif
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="first_name">First Name</label>
										<input type="text" name="first_name" class="form-control" value=""{{old('first_name')}}>
										@if ($errors->has('first_name'))
											<p class="text-danger">{{$errors->first('first_name')}}</p>
										@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="last_name">Last Name</label>
										<input type="text" name="last_name" class="form-control" value=""{{old('last_name')}}>
										@if ($errors->has('last_name'))
											<p class="text-danger">{{$errors->first('last_name')}}</p>
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" name="email" value="{{old('email')}}">
								@if ($errors->has('email'))
									<p class="text-danger">{{$errors->first('email')}}</p>
								@endif
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="password">Password</label>
										<input type="password" class="form-control" name="password" value="{{old('email')}}">
										@if ($errors->has('password'))
											<p class="text-danger">{{$errors->first('password')}}</p>
										@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="password_confirmation">Confirm Password</label>
										<input type="password" class="form-control" name="password_confirmation">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="user_image">User Image</label>
								<input type="file" name="user_image" class="form-control" value="{{old('user_image')}}">
								@if ($errors->has('user_image'))
									<p class="text-danger">{{$errors->first('user_image')}}</p>
								@endif
							</div>					
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-sm btn-outline-warning">Register</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>							
@endsection