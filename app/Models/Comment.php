<?php

namespace App\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */

    protected $fillable = [
    'post_id',
    'user_id',
    'parent_id',
    'comment',
    ];

    public function posts() {

    return $this->belongsTo(Posts::class);

}

   public function user() {

    return $this->belongsTo(User::class);  
    
}

   public function parent()
{
    return $this->belongsTo(Comment::class, 'parent_id');
}

public function replies()
{
    return $this->hasMany(Comment::class, 'parent_id','id')->with('replies');
}

    use HasFactory;
}
