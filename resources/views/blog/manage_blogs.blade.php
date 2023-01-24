@extends('layouts.base')
@section('main')
@include('layouts.navigation')
	<div class="container">
		<div class="row">
			<div class="col-sm-10" style="margin:2rem auto;">
				<div class="card">
					<div class="card-body">
						<h4 class="text-center text-warning">Manage Blogs</h4>
						<table id="manage_blogs" class="table table-hover">
							<thead>
								<tr>
									<th>Sr.#</th>
									<th>Blog Tilte</th>
									<th>Blog Introduction</th>
									<th>Blog Image</th>
									<th>Blog Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($blogs as $blog)
									<tr>
										<td>{{$loop->index+1}}</td>
										<td>{{$blog->blog_title}}</td>
										<td>{{$blog->blog_introduction}}</td>
										<td>
											<img src="{{Storage::url($blog->blog_image)}}" alt="{{$blog->blog_title}}" style="width:80px;height:50px;">
										</td>
										<td>
											@if ($blog->blog_status == 'PENDING')
												<span class="badge text-bg-warning text-light">PENDING</span>
											@elseif($blog->blog_status == 'ACCEPTED')
												<span class="badge text-bg-success text-light">ACCEPTED</span>
											@else
												<span class="badge text-bg-danger text-light">REJECTED</span>
											@endif
										</td>
										<td>
											<a href="/edit_blog/{{$blog->id}}" class="text-info"><i class="fa fa-pen-to-square"></i></a>/ 
											<a href="/delete_blog/{{$blog->id}}" class="text-danger" onclick="return confirm('Are you sure?');"><i class="fa fa-trash-can"></i></a>/
											<a href="/blog_detail_user/{{$blog->id}}" class="text-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	@section('script')
		<script>
			$(document).ready( function () {
				$('#manage_blogs').DataTable();
			} );
		</script>	
	@endsection	
@endsection