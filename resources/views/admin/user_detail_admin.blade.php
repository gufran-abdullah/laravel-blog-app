@extends('admin.partials.admin_dashboard')
@section('admincontent')
	<h1 class="mt-4">{{$user_detail->name}}'s Detail</h1><hr>
    <div class="caontainer">
        <div class="row">
            <div class="col-sm-4" style="margin:5rem auto;">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group text-center">
                                <img src="{{Storage::url($user_detail->user_image)}}" alt="{{$user_detail->name}}" style="width:150px;height:150px;border-radius:50%;">
                            </div>
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" value="{{$user_detail->name}}" disabled>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">First Name</label> 
                                        <input type="text" class="form-control" value="{{$user_detail->first_name}}" disabled>
                                    </div>  
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Last Name</label> 
                                        <input type="text" class="form-control" value="{{$user_detail->last_name}}" disabled>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" value="{{$user_detail->email}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Is Deleted</label>
                                <input type="number" class="form-control" value="{{$user_detail->is_delete}}" disabled>
                            </div>
                            <div class="form-group" style="float: right;">
                                <input type="submit" value="User Detail" class="btn btn-outline-dark mt-3" disabled>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection