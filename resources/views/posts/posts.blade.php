<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/appComment.css') }}">
    <title>Document</title>
</head>

<body>


    <main class="blogsComment">

        <div class="blogContainerComment">

            <div class="blogTitle">
                <h3> {{ $post['title'] }} </h3>
            </div>

            @if ($post->thumb)
                <img class="blogImg" src="{{ asset('storage/' . $post->thumb) }} ">
            @endif

            <blog class="Content">
                {{ $post['content'] }}
            </blog>

            <div class="blogDate">
                {{ $post['created_at'] }}
            </div>

            <div class="blogSlug">
                {{ $post['slug'] }}
            </div>

        </div>

        <form action="commented" class="commentForm" method="POST">

            <div class="comment">
                @csrf

                <input type="hidden" name="post_id" value="{{ $post->id }}">

                    <input type="text" name="comment" placeholder="Digite um comentário" class="commentInput">
                @error('comment')
                     <div class="alert alert-danger">{{ $message }}</div>
                @enderror
               


                <button type="submit" name="commentSubmit" class="commentSubmit">Enviar</button>
            </div>
        </form>


        <div class="comments">

            @foreach($comment as $comments)
                <span class="selfComment">
                    Nome do usuário: {{$comments['user']['name']}} - {{ $comments['comment'] }}

                    @if(Auth::user()->id == $comments['user_id'] || $post->user_id == Auth::id())
                    <form action="{{ route('commentDelete', $comments['id']) }}">
                        <button type="submit">Deletar</button>
                    </form>
                     @endif

                </span>
            @endforeach

        </div>

    </main>

</body>

</html>