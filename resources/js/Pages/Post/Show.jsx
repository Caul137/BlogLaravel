import React, { useEffect, useState } from "react";
import { useForm, usePage } from "@inertiajs/react";
import { Link } from '@inertiajs/react';
import { Inertia } from '@inertiajs/inertia';




export default function Show({ post, comment }) {

    const { auth } = usePage().props
    const [commentAbsolute, setCommentAbsolute] = useState(null)
    const [comments, setComments] = useState(comment || [])
    const [replyContent, setReplyContent] = useState("");

 useEffect(() => {

        const channelName = `have-any-comment.${post.id}`;
        const eventToListen = 'ReverbEvent'; 

     //   console.log("Tentando escutar no canal:", channelName);
      //  console.log(`Listener para '${eventToListen}' sendo adicionado.`);

        
        const channel = window.Echo.channel(channelName);

       
        channel.listen(eventToListen, (eventPayload) => {
            try {
             
                const receivedComment = eventPayload.comment;

               
                console.log("Novo comentário recebido do WebSocket:", receivedComment);

             
                setComments(prevComments => [...prevComments, receivedComment]);

            } catch (e) {
             
                console.error("Erro ao processar dados do ReverbEvent:", e);
                console.log("Payload bruto recebido (para depuração):", eventPayload);
            }
        });

       // console.log(`Listener ativado para '${eventToListen}' no canal '${channelName}'.`);

       
        return () => {
         //   console.log("Listener desativado para o canal:", channelName);
            channel.stopListening(eventToListen); 
        };
    }, [post.id]);
      
  


    const handleToglleAbsolute = (id) => {
        setCommentAbsolute(prevId => prevId === id ? null : id)
    }

    const {
        data,
        setData,
        post: submit,
        processing,
        errors,
        reset,
    } = useForm({
        comment: "",
        post_id: post.id,
        parent_id: null,

    });


    const handleSubmit = (e, parentId = null) => {
        e.preventDefault();


        if (parentId) {
            Inertia.post("/commented", {
                comment: replyContent,
                post_id: post.id,
                parent_id: parentId,
            }, {
                preserveScroll: true,
                onSuccess: () => {
                    setReplyContent("");
                    setCommentAbsolute(null);
                }
            });
        }


        else {
            submit("/commented", {
                preserveScroll: true,
                onSuccess: () => reset("comment"),
            });
        }

    };


    return (
        <main className={`bg-gradient-to-r from-black via-purple-800 to-black min-h-screen overflow-x-hidden  py-10 px-4 `}>


            <div className={`w-full max-w-3xl mx-auto flex flex-col items-center bg-[#100e14] shadow-md rounded-lg p-6`}>
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
                onSubmit={(e) => handleSubmit(e)}
                className="w-full max-w-3xl mx-auto mt-10 bg-[#100e14] shadow-md rounded-lg p-6"
            >
                <h4 className="text-xl font-semibold text-white mb-4">
                    Deixe um comentário
                </h4>

                <input
                    type="text"
                    name="comment"
                    placeholder="Digite um comentário"
                    className="w-full border border-gray-300 rounded px-4 py-2 mb-2 focus:outline-none focus:ring focus:border-blue-400"
                    value={data.comment}
                    onChange={(e) => setData("comment", e.target.value)}
                />

                {!commentAbsolute && errors.comment && (<p>{errors.comment}</p>)}

                <button className="bg-indigo-400 hover:bg-indigo-500 text-white px-4 py-2 rounded transition"
                    type="submit"
                    disabled={auth.user ? false && processing : true}
                >
                    {auth.user ? 'Enviar' : "você precisa estar logado para fazer um comentário"}
                </button>


            </form>


            <div className="w-full max-w-3xl mx-auto mt-8 space-y-4">
                <h4 className="text-lg font-bold text-white mb-2">
                    Comentários:
                </h4>

                {comments.length === 0 && (
                    <p className="text-white">Nenhum comentário ainda.</p>
                )}

                {comments.map((c) => (
                    <div
                        key={c.id}
                        className={`${commentAbsolute === c.id ? 'fixed top-0 right-5 w-[30%] h-[100%] overflow-y-scroll ' : 'static'}   bg-[#100e14] shadow-md p-4 flex flex-col sm:flex-row justify-between items-start border border-purple-800 rounded-2xl `}
                    >

                        <div className="text-gray-400 flex flex-col gap-2">
                            <div className={`${commentAbsolute === c.id ? 'w-auto h-auto p-3 flex flex-col gap-2 border border-purple-800 rounded-3xl text-center' : 'flex flex-col gap-3'}`}>
                                <span className="font-semibold">
                                    Nome do usuário: {c.user.name}
                                </span>
                                <span className="text-white">
                                    Comentário: {c.comment}
                                </span>
                            </div>


                            <div className={`${commentAbsolute === c.id ? '' : 'text-purple-200 p-3'}`}>

                                <button
                                    onClick={() => handleToglleAbsolute(c.id)}
                                    className="text-purple-400 hover:underline my-3"
                                >
                                    {commentAbsolute === c.id ? 'Voltar' : "Responder"}
                                </button>

                                {commentAbsolute === c.id && (
                                    <div className="bg-gray-600 flex flex-col text-center gap-10 p-10 rounded-3xl mb-16 ">
                                        <form onSubmit={(e) => handleSubmit(e, c.id)} >
                                            <input type="text" value={replyContent} onChange={(e) => setReplyContent(e.target.value)} className="w-100% h-10 border border-purple-200 rounded-3xl" />
                                            {errors.comment && <p> {errors.comment} </p>}
                                            <button type="submit" className="m-5 border border-purple-200 rounded-3xl p-2"> Enviar resposta</button>
                                        </form>


                                        {c.replies && c.replies.map(reply => (
                                            <div key={reply.id} className="w-auto h-auto p-3 border border-purple-500 rounded-3xl flex flex-col">
                                                <p className="w-auto h-auto flex flex-col items-start text-start"> <strong>{reply.user.name}: </strong>  {reply.comment}</p>
                                            </div>
                                        ))}

                                    </div>

                                )}


                            </div>



                        </div>



                        {(auth.user?.id === c.user_id ||
                            auth.user?.id === post.user_id) && (
                                <form
                                    action={`/comment/delete/${c.id}`}
                                    method="GET"
                                    className="mt-2 sm:mt-0 sm:ml-4"
                                >
                                    
                                {commentAbsolute === c.id ? '' : <button
                                        type="submit"
                                        className="text-red-600 hover:underline text-sm"
                                    >
                                        Deletar
                                    </button>}

                                </form>
                            )}
                    </div>
                ))}
            </div>

                

        </main>


   


    );
}
