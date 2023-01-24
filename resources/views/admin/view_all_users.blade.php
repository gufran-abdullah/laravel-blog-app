@extends('admin.partials.admin_dashboard')
@section('admincontent')
	<h1 class="mt-4">View all users</h1><hr>
	<div class="container-fluid my-3">
		<div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl">
			<table id="viewAllUsers" class="table table-hover table-sm">
			<thead>
				<tr>
					<th>Sr.#</th>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Userame</th>
					<th>Email</th>
					<th>User Image</th>
					<th>Created Date</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($all_users as $user)
				<tr>
					<td>{{$loop->index+1}}</td>
					<td>{{$user->id}}</td>
					<td>{{$user->first_name}}</td>
					<td>{{$user->last_name}}</td>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>
						<img src="{{Storage::url($user->user_image)}}" alt="{{$user->name}}" style="width:50px;height:50px;border-radius:50%;">
					</td>
					<td>{{$user->created_at}}</td>
					<td>
						<a href="/user_detail_admin/{{$user->id}}" class="text-primary"><i class="fa fa-eye" aria-hidden="true"></i></a> |
						<a href="/delete_user_admin/{{$user->id}}" class="text-danger" onclick="return confirm('Are you sure?');"><i class="fa fa-trash-can"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
			</table>
		</div>
	</div>

	@section('script')
		<script>
			$(document).ready( function () {
				$('#viewAllUsers').DataTable();
			} );
		</script>	
	@endsection 
@endsection	