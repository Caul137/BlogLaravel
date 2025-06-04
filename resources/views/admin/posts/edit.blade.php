<x-app-layout>
    <x-slot name="header">
        
           <meta name="csrf-token" content="{{ csrf_token() }}">
            @vite(['resources/css/app.css', 'resources/js/app.js'])

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Post') }}
        </h2>
        
    </x-slot>

<div>
    <a href="/admin/posts"> Voltar </a>
</div>


<div class="py-12">
     <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-2 py-2"> 

        
            <form action="{{ route('update', $postsAll->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                <div class="w-full px-2 py-2">
                <label>Titulo</label>
                 <input type="text" name="title" value="{{ $postsAll->title }}">
                </div>

                <div class="w-full px-2 py-2">
                 <label>Descrição</label>
                 <input type="text" name="description" value="{{ $postsAll->content }}">
                </div>

                <div class="w-full px-2 py-2">
                 <label>Conteúdo</label>
                 <input type="text" name="content" value="{{ $postsAll->slug }}">
                </div>


         <div class="w-full px-2 py-2">
              <div>
                @if ($postsAll->thumb) 
                    <img src="{{ asset('storage/'.$postsAll->thumb) }}">
                 @endif
               </div>

             <div>
                 <label for="">Imagem Do post</label>
                 <input type="file" name="thumb">
            </div>
               
         </div>

               <button type="submit">Editar</button>
            </form>

         </div>
    </div>
</div>

    </x-app-layout>
