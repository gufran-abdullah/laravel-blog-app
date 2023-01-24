@extends('admin.partials.admin_dashboard')
@section('admincontent')
<h1 class="mt-4">View all Blogs</h1><hr>
<div class="container-fluid my-3">
	<div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl">
		<table id="viewAllUsers" class="table table-hover table-sm">
			<thead>
				<tr>
					<th>Sr.#</th>
					<th>ID</th>
					<th>Blog Title</th>
					<th>Blog Introduction</th>
					<th>Blog Featured Image</th>
					<th>Blog Status</th>
					<th>Created Date</th>
					<th>Updated Date</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($blogs as $blog)
				<tr>
					<td>{{$loop->index+1}}</td>
					<td>{{$blog->id}}</td>
					<td>{{$blog->blog_title}}</td>
					<td>{{$blog->blog_introduction}}</td>
					<td>
						<img src="{{Storage::url($blog->blog_image)}}" alt="{{$blog->blog_title}}" style="width:50px;height:50px;border-radius:50%;">
					</td>
					<td>
						@if ($blog->blog_status == 'PENDING')
							<a href="/change_status/{{$blog->id}}" class="badge text-bg-warning text-light text-decoration-none">PENDING</a>
						@elseif($blog->blog_status == 'ACCEPTED')
							<a href="/change_status/{{$blog->id}}" class="badge text-bg-success text-light text-decoration-none">ACCEPTED</a>
						@else
							<a href="/change_status/{{$blog->id}}" class="badge text-bg-danger text-light text-decoration-none">REJECTED</a>
						@endif
					</td>
					<td>{{$blog->created_at}}</td>
					<td>{{$blog->updated_at}}</td>
					<td class="text-center">
						<a href="/edit_blog_admin/{{$blog->id}}" class="text-info" title="Edit"><i class="fa fa-pen-to-square"></i></a>/
						<a href="/delete_blog_admin/{{$blog->id}}" class="text-danger" title="Delete" onclick="return confirm('Are you sure?');"><i class="fa fa-trash-can"></i></a>/
						<a href="/blog_detail_admin/{{$blog->id}}" class="text-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>		
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

	@section('script')
		<script type="text/javascript">
			$(document).ready(function() {
			    $('#viewAllUsers').DataTable();
			});
		</script>	
	@endsection 
@endsection	