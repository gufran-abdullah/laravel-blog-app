<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminApp extends Controller
{

    public function admin_home()
    {
        $data = [];
        $data['users_count'] = count(User::where('user_type','user')->get());
        $data['blogs_count'] = count(Blog::all());
        $data['pending_posts'] = count(Blog::where('blog_status','PENDING')->get());
        $data['accepted_posts'] = count(Blog::where('blog_status','ACCEPTED')->get());
        $data['rejected_posts'] = count(Blog::where('blog_status','REJECTED')->get());
        return view('admin.admin_home', $data);
    }

    public function view_all_users_view()
    {
        $user = new User();
        $users = $user->where(['user_type' => 'user', 'is_delete' => 0])->orderBy('id','desc')->get();
        return view('admin.view_all_users', ['all_users' => $users]);
    }

    public function user_detail_admin($id)
    {
        $data = [];
        $data['user_detail'] = User::where('id',$id)->first();
        return view('admin.user_detail_admin', $data);
    }

    public function delete_user_admin($id)
    {
        $user = User::where('id',$id)->first();
        User::where('id',$user->id)->update([
            'is_delete' => 1,
        ]);
        return redirect('view_all_users')->withSuccess($user->name.' deleted successfully');
    }

    public function create_user_view()
    {
        return view('admin.create_user');
    }

    public function create_user(Request $request)
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
            return redirect('view_all_users')->withSuccess('User created successfully.');
        }
        return redirect('/create_user')->withError('User does not created.');
    }

    public function view_all_blogs_view()
    {
        $blog = new Blog();
        $blogs = $blog->where('is_delete',0)->orderBy('id','desc')->get();
        return view('admin.view_all_blogs', ['blogs' => $blogs]);
    }

    public function create_blog_admin_view()
    {
        return view('admin.create_blog_admin');
    }

    public function create_blog_admin(Request $request)
    {
        $request->validate([
            'blog_title' => 'required|max:200',
            'blog_intro' => 'required|max:200',
            'blog_description' => 'required',
            'blog_image' => 'nullable|image|mimes:jpg,png,jpeg,gif'
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
            'blog_image' => $imageName,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return redirect('view_all_blogs')->withSuccess('Blog created successfully!');
    }

    public function change_status_view($id)
    {
        $blog = Blog::where('id',$id)->first();
        return view('admin.change_status', ['blog' => $blog]);
    }

    public function change_status(Request $request, $id)
    {
        $request->validate([
            'change_status' => 'required'
        ]);

        Blog::whereId($id)->update([
            'blog_status' => $request->change_status,
        ]);
        return redirect('view_all_blogs')->withSuccess('Blog status updated successfully!');
    }

    public function edit_blog_admin_view($id)
    {
        $blog = Blog::where('id',$id)->first();
        return view('admin.edit_blog_admin', ['blog' => $blog]);
    }

    public function update_blog_admin(Request $request, $id)
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
            return redirect('view_all_blogs')->withSuccess('Blog updated successfully!');
        } else {
            return redirect('edit_blog_admin/'.$id)->withError('Blog does not updated');
        }
    }

    public function delete_blog_admin($id)
    {
        Blog::where('id',$id)->update([
            'is_delete' => 1,
        ]);
        return redirect('view_all_blogs')->withSuccess('Blog deleted successfully');
    }

    public function blog_detail_admin($id)
    {
        $blogDetail = Blog::where('id',$id)->with('users')->first();
        return view('admin.blog_detail_admin', ['blogDetail' => $blogDetail]);
    }

    public function admin_logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
