<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">

            {{ __('Seus Posts') }}
        </h2>
    </x-slot>

    <div>
        <a href="/admin/posts/create">Criar post</a>
    </div>
    <br>
    <a href="/">Pagina inicial</a>

    <hr>
    
    <main class="blogs">

 
                @forelse($postsAuth as $postA)

                    <div class="blogContainerAdmin">

                        <div class="blogTitle">
                            <h3> {{ $postA['title'] }} </h3>
                        </div>

                        @if ($postA->thumb)
                            <img class="blogImg" src="{{ asset('storage/' . $postA->thumb) }} ">
                        @endif

                        <blog class="Content">
                            {{ $postA['content'] }}
                        </blog>

                        <div class="blogDate">
                            {{ $postA['created_at'] }}
                        </div>

                        <div class="blogSlug">
                            {{ $postA['slug'] }}
                        </div>
                         <form action="{{ route('delete', $postA->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <button class="delePostAdmin">Deletar</button>
                    </form>
                    </div>
                   

                @empty
                     <span colspan="4">Nâo existe nenhum blog</>
                @endforelse


   </main>

</x-app-layout>