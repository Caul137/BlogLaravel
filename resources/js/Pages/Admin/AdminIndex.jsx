import { Link } from '@inertiajs/react';
import { router } from '@inertiajs/react';

export default function AdminIndex({postsAuth, userAuth }) {
    return (
        <div className="min-h-screen bg-gradient-to-tr from-black via-black  to-purple-800 px-8 py-10">
          
            <header className="mb-8">
                <h1 className="text-3xl font-bold text-center text-purple-900 mb-4">Seus Posts</h1>
                <div className="flex justify-center gap-6">
                    <Link
                        href="/"
                        className="text-white bg-purple-700 hover:bg-purple-800 px-4 py-2 rounded shadow-md transition"
                    >
                        Página inicial
                    </Link>
                    <Link
                        href="/admin/posts/create"
                        className="text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded shadow-md transition"
                    >
                        Criar um post
                    </Link>
                </div>
            </header>

        
            <main className="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {postsAuth.length > 0 ? (
                    postsAuth.map((post) => (
                        <div
                            key={post.id}
                            className="bg-white rounded-lg shadow-md p-5 flex flex-col justify-between"
                        >
                            <div>
                                <h2 className="flex justify-center text-2xl font-semibold text-purple-800 mb-2">
                                    {post.title}
                                </h2>
                               
                                
                                {post.thumb && (
                                    <img
                                        src={`/storage/${post.thumb}`}
                                        alt="Thumb"
                                        className="w-full h-48 object-cover rounded"
                                    />
                                )}
                                <p className="text-black mb-3 p-3">Descrição: {post.content}</p>
                                <p className="text-sm text-gray-500 mt-2">{post.created_at}</p>
                                <p className="text-sm text-gray-800 mt-2">Slug: {post.slug}</p>
                            </div>

                            <div className="flex gap-4 mt-4">
                                <Link
                                    href={`/admin/posts/edit/${post.id}`}
                                    className="text-blue-700 hover:underline"
                                >
                                    Editar
                                </Link>

                                <form
                                    method="POST"
                                    action={`/admin/posts/delete/${post.id}`}
                                >
                                    <input
                                        type="hidden"
                                        name="_token"
                                        value={
                                            document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                                        }
                                    />
                                    <button
                                        type="submit"
                                        className="text-red-600 hover:underline"
                                    >
                                        Deletar
                                    </button>
                                </form>
                            </div>
                        </div>
                    ))
                ) : (
                    <p className="text-center col-span-full text-gray-600 text-lg">Nenhum post encontrado.</p>
                )}
            </main>
        </div>
    );
}