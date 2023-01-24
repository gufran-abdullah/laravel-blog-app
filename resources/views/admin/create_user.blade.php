@extends('admin.partials.admin_dashboard')
@section('admincontent')
	<h1 class="mt-4">Create New User</h1><hr>
	<div class="container">
		<div class="row">
			<div class="col-sm-6" style="margin:10rem auto;">
				<div class="card">
					<form action="/create_user" method="post" enctype="multipart/form-data">
						@csrf
						<div class="card-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="first_name">First Name</label>
										<input type="text" name="first_name" class="form-control" autofocus>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="last_name">Last Name</label>
										<input type="text" name="last_name" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="name">Username</label>
								<input type="text" name="name" class="form-control">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" name="email" class="form-control">
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="password">Password</label>
										<input type="password" name="password" class="form-control">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="password_confirmation">Confirm Password</label>
										<input type="password" name="password_confirmation" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="user_image">User Image</label>
								<input type="file" name="user_image" class="form-control">
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-outline-dark">Create New User</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>	
@endsection