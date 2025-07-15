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
use \Inertia\Inertia;



class PostController extends Controller
{


    public function posts($id)
    {

     $post = Posts::with('user')->findOrFail($id);
    $comment = Comment::with('user')->where('post_id', $id)->get();

    return Inertia::render('Post/Show', [
        'post' => $post,
        'comment' => $comment,
        'authUser' => auth()->user(),
    ]);

    }


    public function commented(CommentRequest $requestComment)
    {

       
        $comment = new Comment();
        $comment->comment = $requestComment->comment;
        $comment->post_id = $requestComment->post_id;
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



