<x-app-layout>
    <x-slot name="header">
        
           <meta name="csrf-token" content="{{ csrf_token() }}">
            @vite(['resources/css/app.css', 'resources/js/app.js'])

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ciriar Post') }}
        </h2>
        
    </x-slot>

<div>
    <a href="/admin/posts"> Voltar </a>
</div>


<div class="py-12">
     <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-2 py-2"> 

        
            <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

             
                <div class="w-full px-2 py-2">
                <label>Titulo</label>
                 <input type="text" name="title">
                @error('title')
                <span style="color:red">{{ $message }}</span>
                @enderror


                </div>
              
                <div class="w-full px-2 py-2">
                 <label>Descrição</label>
                 <input type="text" name="description">
                </div>


                <div class="w-full px-2 py-2">
                 <label>Conteúdo</label>
                 <input type="text" name="content">
                 @error('content')
                 <span style="color:red">{{ $message }}</span>
                 @enderror
                </div>

                <div class="w-full px-2 py-2">
                 <label for="">Imagem Do post</label>
                 <input type="file" name="thumb">
              @error('thumb')
                  <span style="color:red">{{ $message }}</span>
              @enderror

                </div>


               <button type="submit">Criar</button>
            </form>

         </div>
    </div>
</div>

    </x-app-layout>
