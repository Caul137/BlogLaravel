<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use \Inertia\Inertia;



class AdminController extends Controller
{



    public function indexAdmin()
    {

        $postsAll = Posts::all();
        $usersAll = User::all();

        $userAuth = auth()->user();
        $postsAuth = auth()->user()->posts;

   
        return inertia::render('Admin/AdminIndex', [
            'postsAll' => $postsAll,
            'usersAll' => $usersAll,
            'postsAuth' => $postsAuth,
            'userAuth' => $userAuth 
        ]);
        
    }


    public function createNewBlog()
    {

 

        return inertia::render('Admin/AdminPostsCreate', [
            'routeStore' => route('store')

        ]);
      
    }

    public function store(PostRequest $request)
    {

        $post = new Posts();
        $post->title = $request->title;
        $post->content = $request->description;
        $post->slug = Str::slug($request->title);
        $post->thumb = $request->thumb?->store('posts', 'public');

        //$post->save();

        $user = auth()->user();
        $user->posts()->save($post);
        $posts = auth()->user()->posts;

        return redirect()->route('adminPost');
    }


    public function edit($posts)
    {

        $post = Posts::find($posts);

        return inertia::render('Admin/AdminPostsEdit', [
            'postsAll' => $post
        ]);
       
    }

    public function update($post, PostRequest $request)
    {

    $postModel = Posts::findOrFail($post);

        $data = $request->all();

        if ($request->thumb) {
            if ($postModel->thumb)
                Storage::disk('public')->delete($postModel->thumb);
            $data['thumb'] = $request->thumb?->store('posts', 'public');
            ;
        }

        $post = Posts::find($post);
        $postModel->update($data);


        return redirect()->route('adminPost');
    }


    public function delete($post)
    {
        $post = Posts::find($post);
        $post->delete();

        return redirect()->back();
    }
}
