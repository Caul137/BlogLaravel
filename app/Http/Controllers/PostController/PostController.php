<?php

namespace App\Http\Controllers\PostController;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;




class PostController extends Controller
{


    public function posts(Request $posts)
    {

        $post = Posts::find($posts->id);
        $comment = Comment::where('post_id', $posts->id)->get();

        
        return view('posts.posts', compact('post', 'comment'));;

    }


    public function commented(Request $request)
    {

        $request->validate([
            'comment' => 'required'
            
        ]);


        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return redirect()->back();
    }

    public function noPost(Request $request)
    {

        $id = $request->id;

        echo "<h1> Para ver o post$id você precisa estar logado </h1>";
    }


    public function deleteComment(Request $request){
        $id = $request->id;
        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->back();


    }


}



