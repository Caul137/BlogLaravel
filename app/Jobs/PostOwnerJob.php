<?php

namespace App\Jobs;

use App\Mail\PostOwnerMail;
use App\Models\Comment;
use App\Models\Posts;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PostOwnerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public $comment;
    public $posts;


    public function __construct( Comment $comment, Posts $posts)
    {
        $this->comment = $comment;
        $this->posts = $posts;
    }


    public function handle(): void
    {

        $author = $this->posts->user;
        
        Mail::to($author->email)->send(
            new PostOwnerMail($this->comment, $this->posts)
        );

    }
}
