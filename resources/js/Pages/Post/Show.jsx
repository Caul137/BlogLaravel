import React from "react";
import { useForm } from "@inertiajs/react";
import { Link } from '@inertiajs/react';


export default function Show({ post, comment, authUser }) {
    const {
        data,
        setData,
        post: submit,
        processing,
        errors,
    } = useForm({
        comment: "",
        post_id: post.id,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        submit("/commented", {
            preserveScroll: true,
            onSuccess: () => setData("comment", ""),
        });
    };

    return (
        <main className="bg-gradient-to-r from-black via-purple-800 to-black min-h-screen overflow-x-hidden py-10 px-4">
           
            <div className="w-full max-w-3xl mx-auto flex flex-col items-center bg-[#100e14] shadow-md rounded-lg p-6">
                <Link href={'/'} className="text-purple-50">Voltar a página inicial</Link>
                <h3 className="text-2xl font-bold text-center text-white mb-4">
                    {post.title}
                </h3>

                {post.thumb && (
                    <img
                        className="mt-2 rounded shadow-md w-full max-h-[400px] object-cover"
                        src={`/storage/${post.thumb}`}
                        alt="Imagem do post"
                    />
                )}

                <div className="mt-4 text-white w-full text-lg flex justify-center p-3">
                    {post.content}
                </div>
                <div className="mt-2 text-sm text-gray-400 w-full">
                    Criado em: {post.created_at}
                </div>
                <div className="mt-1 text-sm text-gray-300 w-full">
                    Slug: {post.slug}
                </div>
            </div>

        
            <form
                onSubmit={handleSubmit}
                className="w-full max-w-3xl mx-auto mt-10 bg-[#100e14] shadow-md rounded-lg p-6"
            >
                <h4 className="text-xl font-semibold text-white mb-4">
                    Deixe um comentário
                </h4>
                <input type="hidden" name="post_id" value={post.id} />

                <input
                    type="text"
                    name="comment"
                    placeholder="Digite um comentário"
                    className="w-full border border-gray-300 rounded px-4 py-2 mb-2 focus:outline-none focus:ring focus:border-blue-400"
                    value={data.comment}
                    onChange={(e) => setData("comment", e.target.value)}
                />

                {errors.comment && (
                    <div className="text-red-600 text-sm mb-2">
                        {errors.comment}
                    </div>
                )}

                <button
                    type="submit"
                    className="bg-indigo-400 hover:bg-indigo-500 text-white px-4 py-2 rounded transition"
                    disabled={processing}
                >
                    Enviar
                </button>
            </form>

      
            <div className="w-full max-w-3xl mx-auto mt-8 space-y-4">
                <h4 className="text-lg font-bold text-white mb-2">
                    Comentários:
                </h4>

                {comment.length === 0 && (
                    <p className="text-white">Nenhum comentário ainda.</p>
                )}

                {comment.map((c) => (
                    <div
                        key={c.id}
                        className="bg-[#100e14] shadow-md p-4 rounded flex flex-col sm:flex-row justify-between items-start"
                    >
                        <div className="text-gray-400">
                            <span className="font-semibold">
                                Nome do usuário:
                            </span>{" "}
                            {c.user.name} <br />
                            <span className="text-white">{c.comment}</span>
                        </div>

                        {(authUser?.id === c.user_id ||
                            authUser?.id === post.user_id) && (
                            <form
                                action={`/comment/delete/${c.id}`}
                                method="GET"
                                className="mt-2 sm:mt-0 sm:ml-4"
                            >
                                <button
                                    type="submit"
                                    className="text-red-600 hover:underline text-sm"
                                >
                                    Deletar
                                </button>
                            </form>
                        )}
                    </div>
                ))}
            </div>
        </main>
    );
}
