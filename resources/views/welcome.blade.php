<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Blogs</title>


</head>

<body>
    <header class="header">
        @if (Route::has('login'))
            <nav>
                @auth

                    <a href="{{ url('/dashboard') }}" class="logining">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="logining">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="logining">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>


    <div class="BlogTitle">
        <h1>Blog</h1>
    </div>

    <main class="blogs">


        @auth
            {{ !$redirectPost = "post" }}
        @endauth
        @guest
            {{ !$redirectPost = "noPost" }}
        @endguest


        @foreach($postsAll as $posts)

            <a href="{{ $redirectPost . $posts['id'] }}">
                <div class="blogContainer">


                    <div class="blogTitle">
                        <h3> {{ $posts['title'] }} </h3>
                    </div>

                    @if ($posts->thumb)
                        <img class="blogImg" src="{{ asset('storage/' . $posts->thumb) }} ">
                    @endif

                    <blog class="Content">
                        {{ $posts['content'] }}
                    </blog>

                    <div class="blogDate">
                        {{ $posts['created_at'] }}
                    </div>

                    <div class="blogSlug">
                        {{ $posts['slug'] }}
                    </div>
                </div>
            </a>
            @forelse($postsAll as $posts)
            @empty
                <span colspan="4">Nâo existe nenhum blog</span>
            @endforelse

        @endforeach
    </main>
</body>

</html>