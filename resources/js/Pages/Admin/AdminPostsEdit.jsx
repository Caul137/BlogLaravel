import React, { useState } from 'react';
import { useForm } from '@inertiajs/react';

export default function AdminPostsEdit({ postsAll }) {
    const { data, setData, post, processing, errors } = useForm({
        title: postsAll.title || '',
        description: postsAll.description || '',
        content: postsAll.content || '',
        thumb: null,
    });

    const handleSubmit = (e) => {
        e.preventDefault();

        post(`/admin/posts/update/${postsAll.id}`, {
            forceFormData: true,
            preserveScroll: true,
        });
    };

    return (
    
    <div className='min-h-screen bg-gradient-to-b from-black via-black  to-purple-800 '>
        <div className="p-6">
            <h2 className="text-xl font-semibold text-white">Editar Post</h2>

            <div className="mb-4">
                <a href="/admin/posts" className="text-blue-600">Voltar</a>
            </div>

            <form onSubmit={handleSubmit} className="space-y-4">
                <div>
                    <label className="text-white">Título</label>
                    <input
                        type="text"
                        value={data.title}
                        onChange={(e) => setData('title', e.target.value)}
                        className="border p-2 w-full"
                    />
                    {errors.title && <div className="text-red-600">{errors.title}</div>}
                </div>

                <div>
                    <label className="text-white">Descrição</label>
                    <input
                        type="text"
                        value={data.description}
                        onChange={(e) => setData('description', e.target.value)}
                        className="border p-2 w-full"
                    />
                </div>

                <div>
                    <label className="text-white">Conteúdo</label>
                    <input
                        type="text"
                        value={data.content}
                        onChange={(e) => setData('content', e.target.value)}
                        className="border p-2 w-full"
                    />
                </div>

                <div>
                    <label className=" text-white">Imagem Atual</label>
                    {postsAll.thumb && (
                        <img
                            src={`/storage/${postsAll.thumb}`}
                            alt="Imagem atual"
                            className="w-64 mb-2"
                        />
                    )}
                    <input
                        type="file"
                        onChange={(e) => setData('thumb', e.target.files[0])}
                        className='text-white'
                    />
                    {errors.thumb && <div className="text-red-600">{errors.thumb}</div>}
                </div>

                <button
                    type="submit"
                    className="bg-purple-600 text-white px-4 py-2 rounded"
                    disabled={processing}
                >
                    {processing ? 'Editando...' : 'Editar'}
                </button>
            </form>
        </div>
 </div>
    );
}
