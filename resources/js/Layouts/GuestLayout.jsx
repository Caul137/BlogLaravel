



import React from 'react';

export default function GuestLayout({ children }) {
    return (
        <div className="min-h-screen bg-gradient-to-b from-black via-black to-purple-800 flex justify-center items-center">
          
          
            <main>{children}</main>
        </div>
    );
}
