import React from 'react';
import { Link,usePage } from '@inertiajs/react';

export default function Home({ postsAll, redirectPost, routes }) {
    const { auth } = usePage().props;



    return (
        <div className="bg-[#292828] min-h-screen overflow-x-hidden">
            <header className="relative w-full min-h-[15rem] bg-gradient-to-tr from-black via-purple-800 to-black p-5 flex flex-col justify-center items-center overflow-hidden">

                <div className='w-full flex justify-center items-center'>
                    <h1 className="text-white font-bold text-4xl sm:text-5xl md:text-6xl text-center leading-tight break-words">
                        Blog
                    </h1>
                </div>



                <div className="absolute top-5 right-5">
                    <nav className="flex flex-col items-center justify-center gap-5 text-center px-6 py-4 rounded-lg shadow-md bg-gradient-to-tr from-[#8d82a5] to-[#48227e]">
                        <div className="text-[20px] font-bold text-[#cec2f3] font-sans">
                            {auth.user ? (
                                <p>Olá, {auth.user.name}</p>
                            ) : (
                                <p>Você não está autenticado.</p>
                            )}
                        </div>

                        {route('login') && route('register') && auth.user ? (
                            <div>
                                {routes?.dashboard && (
                                    <Link href={route('dashboard')} className="text-[#cec2f3] font-semibold hover:underline">
                                        Dashboard
                                    </Link>
                                )}
                            </div>
                        ) : (
                            <div className="flex flex-col gap-2">
                                {routes?.login && (
                                    <Link href={route('login')} className="text-[#cec2f3] font-semibold hover:underline">
                                        Login
                                    </Link>
                                )}
                                {routes?.register && (
                                    <Link href={route('register')} className="text-[#cec2f3] font-semibold hover:underline">
                                        Register
                                    </Link>
                                )}
                            </div>
                        )}
                    </nav>
                </div>
            </header>




            <main className="p-6 max-w-7xl mx-auto">
                <h2 className="text-white text-3xl font-bold mb-6 text-center">Todos os Posts</h2>

                {postsAll.length > 0 ? (
                    <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        {postsAll.map((post) => (
                            <div key={post.id} className="bg-black p-4 rounded shadow">
                                <h3 className="text-xl font-semibold text-white text-center">{post.title}</h3>
                                <p className="text-white mt-1 text-center">{post.content}</p>

                                {post.thumb && (
                                    <img
                                        src={`/storage/${post.thumb}`}
                                        alt="Thumb"
                                        className="w-full mt-2 rounded"
                                    />
                                )}

                                <p className="text-sm text-gray-500 mt-2">{post.created_at}</p>

                                <Link
                                    href={`${redirectPost}${post.id}`}
                                    className="block mt-3 text-indigo-600 text-center"
                                >
                                    Ver Post
                                </Link>
                            </div>
                        ))}
                    </div>
                ) : (
                    <p className="text-center text-white">Nenhum post encontrado.</p>
                )}
            </main>
        </div>
    );
}
