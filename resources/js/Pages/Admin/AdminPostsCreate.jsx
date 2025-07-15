import React from 'react';
import { useForm, Link } from '@inertiajs/react';

export default function CreatePost() {
    const { data, setData, post, errors } = useForm({
        title: '',
        description: '',
        content: '',
        thumb: null,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('store'), {
            forceFormData: true,
        });
    };

    return (

    <div className='min-h-screen bg-gradient-to-bl from-black via-black  to-purple-800 p-10 '>

    
        <div className="py-12 px-4 max-w-3xl mx-auto bg-black rounded shadow">
            <div className="mb-4">
                <h2 className="text-xl font-semibold text-white">Criar Post</h2>
                <Link href="/admin/posts" className="text-purple-600 hover:underline">
                    Voltar
                </Link>
            </div>

            <form onSubmit={handleSubmit} encType="multipart/form-data">
                <div className="mb-4">
                    <label className="block font-medium text-white">Título</label>
                    <input
                        type="text"
                        name="title"
                        className="w-full border rounded px-3 py-2"
                        value={data.title}
                        onChange={(e) => setData('title', e.target.value)}
                    />
                    {errors.title && <span className="text-red-600">{errors.title}</span>}
                </div>

                <div className="mb-4">
                    <label className="block font-medium text-white">Descrição</label>
                    <input
                        type="text"
                        name="description"
                        className="w-full border rounded px-3 py-2"
                        value={data.description}
                        onChange={(e) => setData('description', e.target.value)}
                    />
                </div>

                <div className="mb-4">
                    <label className="block font-medium text-white" >Conteúdo</label>
                    <input
                        type="text"
                        name="content"
                        className="w-full border rounded px-3 py-2"
                        value={data.content}
                        onChange={(e) => setData('content', e.target.value)}
                    />
                    {errors.content && <span className="text-red-600">{errors.content}</span>}
                </div>

                <div className="mb-4">
                    <label className="block font-medium text-white">Imagem do post</label>
                    <input
                        type="file"
                        name="thumb"
                        className="w-full text-white "
                        onChange={(e) => setData('thumb', e.target.files[0])}
                    />
                    {errors.thumb && <span className="text-red-600">{errors.thumb}</span>}
                </div>

                <button
                    type="submit"
                    className="bg-purple-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                >
                    Criar
                </button>
            </form>
        </div>
        </div>
    );
}
