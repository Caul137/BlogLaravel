<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    


    protected $policies = [
       
        'App\Models\Posts' => 'App\Policies\PostPolicy',

    ];

  
    public function boot()
    {

        $this->registerPolicies();
     
    //     Gate::define('self', function (User $user, Posts $posts) {
    //       return $user->id === $posts->user_id;
    // });


    Gate::define('commented', function(User $user, Comment $comment) {
           return $user->id === $comment->user_id;
    });
        

    
    }


}