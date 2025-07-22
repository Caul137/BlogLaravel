<?php

namespace App\Http\Controllers\PostController;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Jobs\PostOwnerJob;
use App\Models\Posts;
use Illuminate\Support\Facades\Gate;
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
    $emailOwner = Posts::with('user')->findOrFail($requestComment->post_id);


    //dd($emailOwner->user->email)

    PostOwnerJob::dispatch($comment, $emailOwner);

    if (Gate::denies('commented', $comment)) {
      abort(403);
    }


    return redirect()->back();
  }



  public function deleteComment(Request $request)
  {
    $id = $request->id;
    $comment = Comment::find($id);
    $comment->delete();


    if (Gate::denies('commented', $comment)) {
      abort(403);
    }

    return redirect()->back();


  }


}



