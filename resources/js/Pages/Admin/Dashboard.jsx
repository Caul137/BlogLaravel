import React from 'react';
import { Link } from '@inertiajs/react';
import { router } from '@inertiajs/react';



export default function Dashboard() {


    const handleLogout = () => {
        router.post(route('logout'));
    };


    return (
        <div className="flex flex-col min-h-screen bg-black">
    
           <header className='bg-gradient-to-r from-black via-purple-800 to-black p-10 flex justify-center items-center flex-col'>
            <h1 className="text-3xl font-bold mb-4 text-white">Dashboard</h1>
             <p className='text-2xl text-green-600'>Você está autenticado.</p>
           </header>

        <main className='flex flex-1 justify-center items-center gap-20 ' >

        <div className='bg-black w-auto p-16 rounded-3xl border border-purple-300 cursor-pointer shadow-md shadow-red-400'>
            <button onClick={handleLogout} className="text-red-600 text-2xl">
                Sair
            </button>
        </div>
          
          <div className='bg-black w-auto p-16 rounded-3xl border border-purple-300 cursor-pointer shadow-md shadow-green-400 '>
            <Link href={'/admin/posts'} className="text-green-600 text-2xl" > Seus Posts </Link>
          </div>

        <div className='bg-black w-auto p-16 rounded-3xl border border-purple-300  cursor-pointer shadow-md shadow-gray-400'>
            <Link href={'/'} className="text-gray-300 text-2xl"> Página inicial</Link>
        </div>

        </main>

         


           
        
        </div>
    );
}
