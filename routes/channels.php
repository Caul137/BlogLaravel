<?php

use App\Models\Comment;
use Illuminate\Support\Facades\Broadcast;

use function PHPSTORM_META\map;

Broadcast::channel('have-any-comment.{id}', function ($user, $id) {
    return true;
});


// Broadcast::channel('have-any-comment', function(Comment $comment) {
//        return $comment !== null;

// });