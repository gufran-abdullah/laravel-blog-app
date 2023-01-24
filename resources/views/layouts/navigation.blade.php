@if (Route::has('login'))
    <nav class="navbar navbar-expand-lg bg-light" style="border-bottom:1px solid black;">
        <div class="container">
            <a class="navbar-brand">Blog App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            @auth
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/home">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Blogs
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/create_blog">Create Blog</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/manage_blogs">Manage Blogs</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/manage_profile/{{Auth::user()->id}}">Manage Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/change_password/{{Auth::user()->id}}">Change Password</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{Storage::url(Auth::user()->user_image)}}" alt="{{Auth::user()->name}}" style="width:50px;height:50px;border-radius:50%;">
                        </a>
                        <ul class="dropdown-menu">
                            <li class="text-center"><b>Signed in as</b></li>
                            <li class="text-center"><a class="nav-link text-dark">{{Auth::user()->name}}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/logout" onclick="return confirm('Are you sure?');">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                @else
                <div class="d-flex">
                    <a href="/login" class="btn btn-outline-info btn-sm">Login</a>
                    <a href="/register" class="btn btn-outline-warning mx-2 btn-sm">Register</a>
                </div>
                @endauth
            </div> 
        </div>
    </nav>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger text-center" role="alert"><strong>{{Session::get('error')}}</strong></div>
@endif
@if(Session::has('success'))
    <div class="alert alert-success text-center" role="alert"><strong>{{Session::get('success')}}</strong></div>
@endif