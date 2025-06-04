<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blogs</title>

    
    </head>
    <body>
        <header >
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <br>
        <br>
        <hr>

         <main>
<table class="w-full">
    <th>
        <tr>
               <th class="px-2 py-2 text-left">id</th>
               <th class="px-2 py-2 text-left">Titulo</th>
                <th class="px-2 py-2 text-left">Conteúdo</th>
               <th class="px-2 py-2 text-left">Criado em</th>
               <th class="px-2 py-2 text-left">Slug</th>
               <th class="px-2 py-2 text-left">Imagem</th>
                

        </tr>
    </th>


    <tbody>
       @forelse($postsAll as $posts)
            <td class="px-2 py-2"> {{ $posts['id'] }} </td>
            <td class="px-2 py-2"> {{ $posts['title'] }} </td>
            <td class="px-2 py-2"> {{ $posts['content'] }} </td>
            <td class="px-2 py-2"> {{ $posts['created_at'] }} </td>
            <td class="px-2 py-2"> {{ $posts['slug'] }} </td>
             @if ($posts->thumb) 
               <td class="px-2 py-2">  <img src="{{ asset('storage/'.$posts->thumb) }}"> </td>
                 @endif
          
        </tr>
      @empty
            <tr>
                <td colspan="4">Nâo existe nenhum blog</td>
            </tr>

        @endforelse
    </tbody>

</table>
         

         </main>
     
    </body>
</html>
