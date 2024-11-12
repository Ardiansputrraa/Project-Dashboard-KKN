<?php

namespace App\Http\Controllers;

use App\Models\Dpl;
use App\Models\User;
use App\Models\Admin;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request) {
        $role = $request->query('role');
        if ($role === 'admin') {
            return view('auth.register', ['role' => 'admin']);
        } else if ($role === 'dpl') {
            return view('auth.register', ['role' => 'dpl']);
        }
        return view('auth.register', ['role' => 'mahasiswa']);
    }

    public function registerSave(Request $request) {

        $request->validate([
            'namaLengkap' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required', 
            'role' => 'required|in:admin,dpl,mahasiswa', 
        ]);

        if ($request->role == "admin") {
            $role = 'Admin';
        } else if ($request->role == "mahasiswa") {
            $role = 'Mahasiswa';
        } else if ($request->role == "dpl") {
            $role = 'Dpl';
        }
        
        $user = User::create([
            'namaLengkap' => $request->namaLengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        if ($request->role === 'admin') {
            Admin::create([
                'username' => $user->username,
                'foto' => 'storage/images/profiles/profile.jpeg',
                'namaLengkap'  => $request->namaLengkap,
                'email' => 'Email',
                'nomerWhatsapp' => 'Nomer Whatsapp',
            ]);
        } else if ($request->role === 'mahasiswa') {
            Mahasiswa::create([
                'username' => $user->username,
                'foto' => 'storage/images/profiles/profile.jpeg',
                'namaLengkap'  => $request->namaLengkap,
                'npm' => 'NPM',
                'fakultas' => 'Fakultas',
                'prodi' => 'Prodi',
                'email' => 'Email',
                'nomerWhatsapp' => 'Nomer Whatsapp',
                'status' => 'Belum Terdaftar',
            ]);
        } else if ($request->role === 'dpl') {
            Dpl::create([
                'username' => $user->username,
                'foto' => 'storage/images/profiles/profile.jpeg',
                'namaLengkap'  => $request->namaLengkap,
                'gelar' => 'gelar',
                'inisial' => 'inisial',
                'fakultas' => 'Fakultas',
                'prodi' => 'Prodi',
                'email' => 'Email',
                'nomerWhatsapp' => 'Nomer Whatsapp',
                'status' => 'Belum Terdaftar',
            ]);
        } else {
            return response()->json(['message' => 'Tentukan role akun terlebih dahulu.'], 200);
        }
        return response()->json(['message' => 'Registrasi berhasil.'], 200);
    }

    public function login(){
        return view('auth.login');
    }

    public function loginCheck(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required', 
        ]);
 
        if (!Auth::attempt($request->only('username','password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'username' => trans('auth.failed')
            ]);
        }
        // mengambil user info
        $users = Auth::user();

        $request->session()->regenerate();
        
        return response()->json([
            'message' => 'Login berhasil.',
            'users' => $users,
        ], 200);
    }

    public function logout(Request $request){
        
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Anda telah berhasil logout');
    }
    
}
