<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seus Posts') }}
        </h2>
    </x-slot>

    <div>
        <a href="/admin/posts/create">Criar post</a>
    </div>
    <br>
    <a href="/">Pagina inicial</a>

    <hr>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <th>
                        <tr>
                            <th class="px-2 py-2 text-left">id</th>
                            <th class="px-2 py-2 text-left">Titulo</th>
                            <th class="px-2 py-2 text-left">Criado em</th>
                            <th class="px-2 py-2 text-left">Ações</th>
                            <th class="px-2 py-2 text-left">Imagem</th>



                        </tr>
                    </th>


                    <tbody>
                        @forelse($postsAuth as $postA)
                            <tr>
                                <td class="px-2 py-2"> {{ $postA['id'] }} </td>
                                <td class="px-2 py-2"> {{ $postA['title'] }} </td>
                                <td class="px-2 py-2"> {{ $postA['created_at'] }} </td>
                                <td class="px-2 py-2"> <a href="/admin/posts/edit/{{ $postA['id'] }}">Editar</a> </td>
                                <td class="px-2 py-2">
                                    <form action="{{ route('delete', $postA->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <button>Deletar</button>
                                    </form>
                                </td>
                                @if ($postA->thumb)
                                    <td class="px-2 py-2"> <img src="{{ asset('storage/' . $postA->thumb) }}"> </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Nâo existe nenhum blog</td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>
    </div>

</x-app-layout>