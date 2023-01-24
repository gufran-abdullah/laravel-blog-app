@extends('admin.partials.admin_dashboard')
@section('admincontent')
	<h1 class="mt-4">Dashboard</h1><hr>
	<div class="row">
		<div class="col-sm-2">
			<div class="card" style="border:1px solid black;">
                <div class="card-body" style="background-color: white;">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="deep-orange">{{$users_count}}</h3>
                                <span>Users</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<div class="col-sm-2">
			<div class="card" style="border:1px solid black;">
                <div class="card-body" style="background-color: white;">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="deep-orange">{{$blogs_count}}</h3>
                                <span>Blog Posts</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<div class="col-sm-2">
			<div class="card" style="border:1px solid black;">
                <div class="card-body" style="background-color: white;">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="deep-orange">{{$pending_posts}}</h3>
                                <span>Pending Blog Posts</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<div class="col-sm-2">
			<div class="card" style="border:1px solid black;">
                <div class="card-body" style="background-color: white;">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="deep-orange">{{$accepted_posts}}</h3>
                                <span>Accepted Blog Posts</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<div class="col-sm-2">
			<div class="card" style="border:1px solid black;">
                <div class="card-body" style="background-color: white;">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="deep-orange">{{$rejected_posts}}</h3>
                                <span>Rejected Blog Posts</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
@endsection