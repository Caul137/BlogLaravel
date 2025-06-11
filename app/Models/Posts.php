<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Posts extends Model
{
    /** @use HasFactory<\Database\Factories\PostsFactory> */
    use HasFactory;


      protected $fillable = [
        'title',
        'content',
        'slug',
        'thumb',
       
    ];


public function user(): BelongsTo {

  return $this->belongsTo(User::class);

}

public function comment(): HasMany {
    return $this->hasMany(Comment::class);
}


}
