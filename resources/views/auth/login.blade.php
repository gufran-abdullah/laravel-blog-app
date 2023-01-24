@extends('layouts.base')
@section('main')
	<div class="container">
		<div class="row">
			<div class="col-sm-4" style="margin:15rem auto;">
				<div class="card">
					<form action="/login" method="post">
						@csrf
						<input type="hidden" name="user_type" value="user">
						<div class="card-body">
							<div class="d-flex">
								<a href="/" class="text-warning text-decoration-none"><i class="fa fa-arrow-left-long"></i>Back</a>
								<h4 class="text-center text-warning" style="margin-left:100px;">Login Here</h4>
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" name="email" value="{{old('email')}}" autofocus>
								@if ($errors->has('email'))
									<p class="text-danger">{{$errors->first('email')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" name="password" value="{{old('email')}}">
								@if ($errors->has('password'))
									<p class="text-danger">{{$errors->first('password')}}</p>
								@endif
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-sm btn-outline-warning">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>							
@endsection