<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $users = Auth::user();
        $admin = $users->admin;
        $mahasiswa = $users->mahasiswa;
        $dpl = $users->dpl;
       
        return view('profile.profile', compact('users', 'admin', 'mahasiswa', 'dpl'));
    }

    public function updateProfile(Request $request)
    {


        $users = Auth::user();
  
        if ($users->role == 'Admin') {
            if ($request->hasFile('foto')) {
                if ($users->admin->foto && Storage::exists($users->admin->foto)) {
                    Storage::delete($users->admin->foto);
                }
    
                $image = $request->file('foto');
                $imageName = $users->username . '.' . $image->getClientOriginalExtension();
                $path = 'storage/images/profiles/' . $imageName;
                $image->move(public_path('storage/images/profiles'), $imageName);
    
                $users->admin->foto = $path;
            }
            $users->namaLengkap = $request->namaLengkap;
            $users->admin->namaLengkap = $request->namaLengkap;
            $users->admin->email = $request->email;
            $users->admin->nomerWhatsapp = $request->nomerWhatsapp;
            $users->admin->save();

        } else if ($users->role == 'Mahasiswa') {
            if ($request->hasFile('foto')) {
                if ($users->mahasiswa->foto && Storage::exists($users->mahasiswa->foto)) {
                    Storage::delete($users->mahasiswa->foto);
                }
    
                $image = $request->file('foto');
                $imageName = $users->username . '.' . $image->getClientOriginalExtension();
                $path = 'storage/images/profiles/' . $imageName;
                $image->move(public_path('storage/images/profiles'), $imageName);
    
                $users->mahasiswa->foto = $path;
            }

            $users->namaLengkap = $request->namaLengkap;
            $users->mahasiswa->namaLengkap = $request->namaLengkap;
            $users->mahasiswa->npm = $request->npm;
            $users->mahasiswa->fakultas = $request->fakultas;
            $users->mahasiswa->prodi = $request->prodi;
            $users->mahasiswa->email = $request->email;
            $users->mahasiswa->nomerWhatsapp = $request->nomerWhatsapp;
            $users->mahasiswa->save();
            
        } else if ($users->role == 'Dpl') {
            if ($request->hasFile('foto')) {
                if ($users->dpl->foto && Storage::exists($users->dpl->foto)) {
                    Storage::delete($users->dpl->foto);
                }
    
                $image = $request->file('foto');
                $imageName = $users->username . '.' . $image->getClientOriginalExtension();
                $path = 'storage/images/profiles/' . $imageName;
                $image->move(public_path('storage/images/profiles'), $imageName);
    
                $users->dpl->foto = $path;
            }

            $users->namaLengkap = $request->namaLengkap;
            $users->dpl->namaLengkap = $request->namaLengkap;
            $users->dpl->gelar = $request->gelar;
            $users->dpl->inisial = $request->inisial;
            $users->dpl->fakultas = $request->fakultas;
            $users->dpl->prodi = $request->prodi;
            $users->dpl->email = $request->email;
            $users->dpl->nomerWhatsapp = $request->nomerWhatsapp;
            $users->dpl->save();
        }


        return redirect()->back()->with('success', 'Profile berhasil di update.');
    }
}