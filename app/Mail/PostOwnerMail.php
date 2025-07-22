<?php

namespace App\Mail;

use App\Models\Comment;
use App\Models\Posts;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostOwnerMail extends Mailable
{
    use Queueable, SerializesModels;

   
    public $comment;
    public $posts;


    public function __construct(Comment $comment, Posts $posts)
    {
        $this->comment = $comment;
        $this->posts = $posts;
    }

   
    public function build()
    {
       
        return $this->subject('você tem um novo comentário em seu post')->view('mails.email')->with([
            'coment'=> $this->comment,
            'post' => $this->posts,
        ]);


    }


}
