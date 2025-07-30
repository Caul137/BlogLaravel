<?php

namespace App\Http\Controllers\PostController;

use App\Events\ReverbEvent;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Jobs\PostOwnerJob;
use App\Models\Posts;
use Illuminate\Support\Facades\Gate;
use \Inertia\Inertia;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{


  public function posts($id)
  {

    $post = Posts::with('user')->findOrFail($id);
    $comments = Comment::where('post_id', $id)
      ->whereNull('parent_id')
      ->with(['user', 'replies.user'])
      ->get();


      
    return Inertia::render('Post/Show', [
      'post' => $post,
      'comment' => $comments,
      'authUser' => auth()->user(),
    ]);

  }


  public function commented(CommentRequest $requestComment)
  {


    $comment = new Comment();
    $comment->comment = $requestComment->comment;
    $comment->post_id = $requestComment->post_id;
    $comment->parent_id = $requestComment->parent_id;
    $comment->user_id = auth()->user()->id;
    if (Gate::denies('commented', $comment)) {
      abort(403);
    }
    $comment->save();
    
    //$comment->load('user');
  broadcast(new ReverbEvent($comment));
    
    $emailOwner = Posts::with('user')->findOrFail($requestComment->post_id);
    PostOwnerJob::dispatch($comment, $emailOwner);



    return redirect()->back();
  }



  public function deleteComment(Request $request)
  {

    $id = $request->id;
    $comment = Comment::find($id);

    if (Gate::denies('commented', $comment)) {
      abort(403);
    } else {
      $comment->delete();
    }

    return redirect()->back();

  }



}



