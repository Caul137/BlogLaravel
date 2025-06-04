<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;




class Post extends Controller
{
    public function index() {

        
        $postsAll = Posts::all();
        $usersAll = User::all();


        $dados = [
            'postsAll' => $postsAll,
            'usersAll' => $usersAll
        ];

      


    return view('welcome', $dados);
       
}


 public function indexAdmin() {

    $postsAll = Posts::all();
    $usersAll = User::all();

    $userAuth = auth()->user();
    $postsAuth = auth()->user()->posts;

    $dados = [
        'postsAll' => $postsAll,
        'usersAll' => $usersAll,
        'postsAuth' => $postsAuth
    ];

    return view('admin.posts.index',$dados);
       

}


public function createNewBlog() {

 return view('admin.posts.create');

}

public function store(PostRequest $request) {

    $post = new Posts();
   $post->title = $request->title;
   $post->content = $request->description;
    $post->slug = Str::slug($request->title);
  $post->thumb = $request->thumb?->store('posts', 'public');
  
  //$post->save();
  
  $user = auth()->user();
  $user->posts()->save($post);
  $posts = auth()->user()->posts;
  
 return redirect()->route(('adminPost'));

}


public function edit($posts) {

    $post = Posts::find($posts);

     $dados = [
        'postsAll' => $post
    ];

 return view('admin.posts.edit', $dados);

}

public function update($post, PostRequest $request) {

    $data = $request->all();
    if($request->thumb) {

       if($post->thumb) Storage::disk('public')->delete($post->thumb);
      $data['thumb'] = $request->thumb?->store('posts', 'public');;

    }
   
   $post = Posts::find($post);
   $post->update($data);

   
    return redirect()->route('adminPost', $post->id);
}


public function delete($post) {
    $post = Posts::find($post);
    $post->delete();

 return redirect()->back();
}



}
