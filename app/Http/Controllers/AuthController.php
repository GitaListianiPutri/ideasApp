<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function store()
    {
        $validated = request()->validate(
            [
                'name' => 'required|min:3|max:40',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:8'
            ]
        );

    
        User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),

            ]
        );

        return redirect()->route('dashboard')->with('success', 'Akun anda berhasil dibuat');
    }

    public function login()
    {
        return view('auth.login');
    }
    public function authenticate()
    {
        $validated = request()->validate(
            [
                
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]
        );

        // jika ada user dengan email yang sesuai dengan database itu akan melanjutkan dan secara otomatis login
        if(auth()->attempt($validated)){
            request()->session()->regenerate();
            
            return redirect()->route('dashboard')->with('success', 'Login berhasil');
        };

        return redirect()->route('login')->withErrors([
            'email' => 'Email atau Password yang anda masukkan salah'
        ]);
    }

    public function logout(){
        auth()->logout();


        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', 'Anda berhasil logout');

    }
}
