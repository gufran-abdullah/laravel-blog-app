@extends('admin.partials.admin_dashboard')
@section('admincontent')
	<h1 class="mt-4">Change Status for <em>"{{$blog->blog_title}}"</em></h1><hr>
	<div class="container">
		<div class="row">
			<div class="col-sm-6" style="margin:10rem auto;">
				<div class="card">
					<form action="/change_status/{{$blog->id}}" method="post">
						@csrf
						@method('put')
						<div class="card-body">
							<div class="form-group">
								<label for="name">Blog Title</label>
								<input type="text" value="{{$blog->blog_title}}" class="form-control" readonly>
							</div>
							<div class="form-group mt-4">
								<label for="change_status">Change Status ({{$blog->blog_status}})</label>
								<select name="change_status" class="form-select form-control">
									@if ($blog->blog_status == 'PENDING')
										<option value="ACCEPTED">ACCEPTED</option>
										<option value="REJECTED">REJECTED</option>
									@elseif($blog->blog_status == 'ACCEPTED')
										<option value="PENDING">PENDING</option>
										<option value="REJECTED">REJECTED</option>
									@else
										<option value="PENDING">PENDING</option>
										<option value="ACCEPTED">ACCEPTED</option>
									@endif
								</select>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-outline-dark">Change Status</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection