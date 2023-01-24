<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogApp extends Controller
{
    public function get_num_of_words($string) {
        $string = preg_replace('/\s+/', ' ', trim($string));
        $words = explode(" ", $string);
        return count($words); 
    }

    public function index()
    {
        $data = [];
        $blogs = Blog::where('blog_status','ACCEPTED')->with('users')->orderBy('id','desc')->get();
        $page = Paginator::resolveCurrentPage() ?: 1;
        $perPage = 6;
        $blogs = new LengthAwarePaginator(
            $blogs->forPage($page, $perPage), 
            $blogs->count(), 
            $perPage, $page, 
            ['path' => Paginator::resolveCurrentPath()]
        );
        $data['blogs'] = $blogs; 
        return view('index', $data);
    }

    public function blog_detail_view_guest($id)
    {
        $data = [];
        $blog = Blog::where('id',$id)->with('users')->first();
        $words = $this->get_num_of_words(strip_tags($blog->blog_description));
        $minutes = floor($words / 280);
        $seconds = floor($words % 280 / (280 / 60));
        if (1 <= $minutes) {
            $data['words_count'] = $minutes . ' ' . 'min read';
        } else {
            $data['words_count'] = $seconds . ' ' . 'sec read';
        }
        $data['blog'] = $blog;
        return view('blog_detail_guest', $data);
    }

    /**
     * 
     * 
     * Authentication
     * 
     */

    public function login_view()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email','password'))) {
            if (Auth::user()->user_type == 'admin')
            {
                return redirect('admin_home');  // admin dashboard path
            } elseif (Auth::user()->user_type == 'user') {
                return redirect('home');  // member dashboard path
            }
        }
        return redirect('login')->withError('Invalid Credentials!');
    }

    public function register_view()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20|unique:users',
            'first_name' => 'nullable|max:10',
            'last_name' => 'nullable|max:10',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|max:50',
            'user_image' => 'nullable|image|mimes:jpg,png,jpeg,gif'
        ]);
        
        $imageName = null;
        if ($request->hasFile('user_image')){
            $imageName = $request->file('user_image')->store('userImages','public');
        }

        User::create([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_image' => $imageName
        ]);

        if (Auth::attempt($request->only('email','password'))) {
            return redirect('home');
        }
        return redirect('register')->withError('error');
    }

    /**
     * 
     * 
     * Blog Section
     * 
     */

    public function home_view()
    {
        $data = [];
        $blog = new Blog();
        $blogs = $blog->where('user_id', auth()->user()->id)->orderBy('id','desc')->get();
        $page = Paginator::resolveCurrentPage() ?: 1;
        $perPage = 6;
        $blogs = new LengthAwarePaginator(
            $blogs->forPage($page, $perPage), 
            $blogs->count(), 
            $perPage, $page, 
            ['path' => Paginator::resolveCurrentPath()]
        );
        $data['blogs'] = $blogs;
        return view('blog.home', $data);
    }

    public function blog_detail_view($id)
    {
        $data = [];
        $blog = Blog::where('id',$id)->first();
        $words = $this->get_num_of_words(strip_tags($blog->blog_description));
        $minutes = floor($words / 280);
        $seconds = floor($words % 280 / (280 / 60));
        if (1 <= $minutes) {
            $data['words_count'] = $minutes . ' ' . 'min read';
        } else {
            $data['words_count'] = $seconds . ' ' . 'sec read';
        }   
        $data['blog'] = $blog;
        return view('blog.blog_detail', $data); 
    }

    public function manage_profile_view($id)
    {
        $data = [];
        $user = User::where('id',$id)->first();
        $data['user'] = $user;
        return view('blog.manage_profile', $data);
    }

    public function manage_profile(Request $request, $id)
    {
        $user = User::where('id',$id)->first();
        $user->name = $request->name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->user_image = empty($request->user_image) ? $user->user_image : $request->user_image->store('userImages','public');
        $user->save();
        return redirect('home')->withSuccess('Profile Updated Successfully!');
    }

    public function change_password_view($id)
    {
        $data = [];
        $user = User::where('id',$id)->first();
        $data['user'] = $user;
        return view('blog.change_password', $data);
    }

    public function change_password(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|max:50'
        ]);

        $user = User::where('id',$id)->first();
        if (!Hash::check($request->current_password, $user->password)){
            return redirect('change_password'.'/'.$user->id)->withError('Wrong Password');
        } else {
            User::whereId($user->id)->update([
                'password' => Hash::make($request->new_password),
            ]);
            return redirect('home')->withSuccess('Password changed successfully!');
        }
    }

    public function create_blog_view()
    {
        return view('blog.create_blog');
    }

    public function create_blog(Request $request)
    {
        $request->validate([
            'blog_title' => 'required|max:255',
            'blog_intro' => 'required|max:200',
            'blog_description' => 'required',
            'blog_image' => 'nullable|mimes:jpg,png,jpeg,gif'
        ]);

        $imageName = null;
        if ($request->hasFile('blog_image')){
            $imageName = $request->blog_image->store('blogImages','public');
        }

        Blog::create([
            'user_id' => Auth::user()->id,
            'blog_title' => $request->blog_title,
            'blog_introduction' => $request->blog_intro,
            'blog_description' => $request->blog_description,
            'blog_image' => $imageName
        ]);
        return redirect('manage_blogs')->withSuccess('Blog created successfully!');
    }

    public function manage_blogs_view()
    {
        $data = [];
        $blog = new Blog();
        $blogs = $blog->where("user_id",auth()->user()->id)->orderBy('id','desc')->get();
        $data['blogs'] = $blogs;
        return view('blog.manage_blogs', $data);
    }

    public function edit_blog_view($id)
    {
        $data = [];
        $blog = Blog::where('id',$id)->first();
        $data['blog'] = $blog;
        return view('blog.edit_blog', $data);
    }

    public function update_blog(Request $request, $id)
    {
        $blog = Blog::where('id',$id)->first();
        if (!empty($blog)){
            Blog::whereId($blog->id)->update([
            'blog_title' => $request->blog_title,
            'blog_introduction' => $request->blog_intro,
            'blog_description' => $request->blog_description,
            'blog_image' => empty($request->blog_image) ? $blog->blog_image : $request->blog_image->store('blogImages','public'),
            'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect('manage_blogs')->withSuccess('Blog updated successfully!');
        } else {
            return redirect('edit_blog')->withError('Blog does not updated');
        }
        
    }

    public function delete_blog($id)
    {
        $blog = Blog::where('id', $id)->first();
        $blog->delete();
        return redirect('manage_blogs')->withSuccess('Blog deleted successfully!');
    }

    public function blog_detail_user($id)
    {
        $blog = Blog::where('id',$id)->with('users')->first();
        return view('blog.blog_detail_user', ['blog' => $blog]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
