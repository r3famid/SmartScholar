<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('profile');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'jenjang' => 'required|in:smp,sma,smk,kuliah,tidak_bekerja',
            'nim' => 'nullable|string|max:20',
            'nisn' => 'nullable|string|max:20',
            'jurusan' => 'nullable|string|max:255',
            'semester' => 'nullable|integer|min:1|max:14',
            'ipk' => 'nullable|numeric|min:0|max:4',
            'universitas' => 'nullable|string|max:255',
            'sekolah' => 'nullable|string|max:255',
            'kelas' => 'nullable|string|max:10',
            'last_education' => 'nullable|string|max:255',
            'skills' => 'nullable|string|max:2000',
            'experience' => 'nullable|string|max:5000',
            'organisasi' => 'nullable|string|max:5000',
        ]);

        Auth::user()->update($request->only([
            'name',
            'jenjang',
            'nim',
            'nisn',
            'jurusan',
            'semester',
            'ipk',
            'universitas',
            'sekolah',
            'kelas',
            'last_education',
            'skills',
            'experience',
            'organisasi',
        ]));

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
