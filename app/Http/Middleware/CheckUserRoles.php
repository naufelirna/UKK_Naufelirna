<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; //tambahkan facade auth

class CheckUserRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        ///** ... */ adalah blok komentar PHPDoc.
        //@var digunakan untuk menunjukkan tipe data sebuah variabel.
        //\App\Models\User adalah nama class (dalam hal ini model User).
        //$user adalah nama variabel.
        //ini
        /** @var \App\Models\User $user */

        $user = Auth::user(); 
        //mengambil data user yang sedang login 
        // $user->name, $user->id dan disimpan di variabel $user

        //if = jika
        //(!Auth::check()) = variabel utk cek user udh login pa belum, udh? true. belum? false
        //digabung = jika user blm login
        // || operator atau. jika salah satu bernilai true, maka if akan dijalankan
        //!$user->hasAnyRole(['super_admin', 'admin_guru']))
        //!$user = jika user gak ada role
        //hasAnyRole = jika punya salah satu dari role yg disebutkan. hasilnya akan true
        //abort = jika user gapunya role (!$user) hasAnyRole maka abort
        if (!Auth::check() || !$user->hasAnyRole(['super_admin', 'admin_guru', 'siswa'])) {
            //abort(403, 'Kamu belum punya akses');
            return redirect()->route('tunggu');
        }
        
        return $next($request); //kalau udh bisa, dilanjut req yg lain
    }
}
