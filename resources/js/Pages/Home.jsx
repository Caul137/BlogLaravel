import React from 'react';
import { Link } from '@inertiajs/react';

export default function Home({ postsAll, userAuth, routeHasLogin, routeHasRegister, redirectPost, routes }) {
    return (
        <div className="bg-[#292828] min-h-screen overflow-x-hidden">

            <header className="relative w-full h-[15rem] bg-gradient-to-tr from-black via-purple-800 to-black p-5">

                <div className='absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 '>
                    <h1 className='text-white font-bold text-5xl'>Blog </h1>
                  {/* <img src="/storage/imgs/astro.png" alt="imagem de astro" className='w-100 h-48 rounded'>*/ }
                </div>

        <div className='flex justify-end items-center'>
                <main className="flex flex-col items-center justify-center gap-5 text-center px-6 py-4 rounded-lg shadow-md bg-gradient-to-tr from-[#8d82a5] to-[#48227e]">

                    <div className="text-[20px] font-bold text-[#cec2f3] font-sans">
                        {userAuth ? (
                            <p>Olá, {userAuth.name}</p>
                        ) : (
                            <p>Você não está autenticado.</p>
                        )}
                    </div>

                    {routeHasLogin && routeHasRegister && userAuth ? (
                        <div>
                            {routes?.dashboard && (
                                <Link href={routes.dashboard} className="text-[#cec2f3] font-semibold hover:underline">Dashboard</Link>
                            )}
                        </div>
                    ) : (
                        <div className="flex flex-col gap-2">
                            {routes?.login && (
                                <Link href={routes.login} className="text-[#cec2f3] font-semibold hover:underline">Login</Link>
                            )}
                            {routes?.register && (
                                <Link href={routes.register} className="text-[#cec2f3] font-semibold hover:underline">Register</Link>
                            )}
                        </div>
                    )}
                </main>
                </div>
            </header>


            <main className="p-6 max-w-7xl mx-auto">
                <h1 className="text-white text-3xl font-bold mb-6 text-center">Todos os Posts</h1>


                {postsAll.length > 0 ? (
                    <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        {postsAll.map((post) => (
                            <div key={post.id} className="bg-black p-4 rounded shadow">
                                <h2 className="text-xl font-semibold text-white flex justify-center">{post.title}</h2>
                                <p className="text-white mt-1 flex justify-center">{post.content}</p>

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
                                    className="block mt-3 text-indigo-600"
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
