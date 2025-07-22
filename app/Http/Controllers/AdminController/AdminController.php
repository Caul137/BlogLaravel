<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use \Inertia\Inertia;
use function Laravel\Prompts\alert;

class AdminController extends Controller
{


     public function dashboard()
    {


        //dd(auth()->user()->posts());
    
        return inertia::render('Admin/Dashboard', [
            
        ]);

    }



    public function indexAdmin()
    {
        $postsAuth = auth()->user()->posts;
    
        return inertia::render('Admin/AdminPosts', [
            'postsAuth' => $postsAuth,
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

        $user = auth()->user();
        $user->posts()->save($post);

          if (!Gate::authorize('view', $post)) {
            abort(403);
          }

        return redirect()->route('adminPost');
    }


    public function edit($posts)
    {

        $post = Posts::find($posts);

        if (!Gate::authorize('view', $post)) {
            abort(403);
        }


        return inertia::render('Admin/AdminPostsEdit', [
            'postsAll' => $post
        ]);

    }

    public function update($post, PostRequest $request )
    {
        $postModel = Posts::findOrFail($post);

        if (!Gate::authorize('view', $postModel)) {
            abort(403);
        }

      

        
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


        if (!Gate::authorize('view', $post)) {
            abort(403);
        }


        return redirect()->back();
    }
}
