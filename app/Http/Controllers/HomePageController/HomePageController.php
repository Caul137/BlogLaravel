<?php

namespace App\Http\Controllers\HomePageController;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;




class HomePageController extends Controller
{
    public function index()
    {

        $postsAll = Posts::all();
        $usersAll = User::all();

        $userAuth = auth()->user();
        $postsAuth = auth()->user();

        $dados = [
            'postsAll' => $postsAll,
            'usersAll' => $usersAll,
            'postsAuth' => $postsAuth
        ];

        return view('welcome', $dados);

    }


}
