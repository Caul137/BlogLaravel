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
       # $usersAll = User::all();

        $userAuth = auth()->user();
        $postsAuth = auth()->user();


        $routeHasLogin = Route::has('login');
        $routeHasRegister = Route::has('register');
        $urlDashBoard = url('/dashboard');
        $urlPosts = url('/post');
        $noPost = url('noPost');
        if($userAuth ){
            $redirectPost = $urlPosts;
        } else {
            $redirectPost = $noPost;
        }
       



        return Inertia::render('Home',[

            'postsAll' => $postsAll,
            'postsAuth' => $postsAuth,
            'userAuth' => $userAuth,
            'routeHasLogin' => $routeHasLogin,
            'routeHasRegister' => $routeHasRegister,
            'redirectPost' => $redirectPost,
            'routes' => [
            'login' => route('login'),
            'register' => route('register'),
            'dashboard' => route('dashboard'),
        ],
        

        ]);

    }


}
