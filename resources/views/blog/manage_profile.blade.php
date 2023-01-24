@extends('layouts.base')
@section('main')
@include('layouts.navigation')
	<div class="container my-2">
		<div class="row">
			<div class="col-sm-6" style="margin:10rem auto;">
				<div class="card">
					<div class="card-body">
						<h4 class="text-center text-warning">Update Profile</h4>
						<form method="post" action="/manage_profile/{{$user->id}}" enctype="multipart/form-data">
							@csrf
							@method('put')
							<div class="form-group">
								<label for="name">Username</label>
								<input type="text" name="name" class="form-control" value="{{$user->name}}">
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="first_name">First Name</label>
										<input type="text" name="first_name" class="form-control" value="{{$user->first_name}}">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="last_name">Last Name</label>
										<input type="text" name="last_name" class="form-control" value="{{$user->last_name}}">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" name="email" class="form-control" value="{{$user->email}}">
							</div>
							<div class="row mt-2">
								<div class="col-sm-8">
									<div class="form-group">
										<label for="user_image">User Image</label>
										<input type="file" name="user_image" class="form-control">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group text-center">
										<img src="{{Storage::url($user->user_image)}}" alt="{{$user->name}}Image" style="width:100px;height:100px;">
									</div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-outline-warning btn-sm mt-3">Update Profile</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
