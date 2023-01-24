@extends('layouts.base')
@section('main')
@include('layouts.navigation')
	<div class="container">
		<div class="row">
			<div class="col-sm-6" style="margin:10rem auto;">
				<div class="card">
					<div class="card-body">
						<h4 class="text-center text-warning">Change Password</h4>
						<form method="post" action="/change_password/{{$user->id}}">
							@csrf
							@method('put')
							<div class="form-group">
								<label for="current_password">Current Password</label>
								<input type="password" name="current_password" class="form-control" value="{{old('current_password')}}" autofocus>
								@if ($errors->has('current_password'))
									<p class="text-danger">{{$errors->first('current_password')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label for="new_password">New Password</label>
								<input type="password" name="new_password" class="form-control" value="{{old('new_password')}}">
								@if ($errors->has('new_password'))
									<p class="text-danger">{{$errors->first('new_password')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label for="new_password_confirmation">Confirm Password</label>
								<input type="password" name="new_password_confirmation" class="form-control">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-outline-warning mt-3">Change Password</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>			
@endsection