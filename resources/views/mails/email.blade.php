<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>




<div>
    <h2>Olá {{ $post->user->name }}</h2>
    <p>O seu post "<strong> {{ $post->title  }} </strong>" recebeu um novo comentário de
        <strong>{{ $comment->user->name }}</strong>!! </p>
</div>


<div>
    <p>{{ $comment->user->name }} fez o seguinte comentário:</p>



    <p> {{ $comment->comment }} </p>
</div>


</html>