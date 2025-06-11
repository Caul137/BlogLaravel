<?php

namespace App\Models;

use App\Http\Controllers\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */

    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
    ];

    public function posts() {

    return $this->belongsTo(Posts::class);

}

   public function user() {

    return $this->belongsTo(User::class);

}



    use HasFactory;
}
