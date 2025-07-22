<?php

namespace App\Http\Controllers\HomePageController;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use \Inertia\Inertia;



class HomePageController extends Controller
{
    public function index()
    {

        $postsAll = Posts::all();
 
        $urlPosts = url('/post');

        return Inertia::render('Home',[

            'postsAll' => $postsAll,
            'redirectPost' => $urlPosts,
            'routes' => [
            'login' => route('login'),
            'register' => route('register'),
            'dashboard' => route('dashboard'),
        ],
        

        ]);

    }


}
