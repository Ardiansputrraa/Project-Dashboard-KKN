<?php

namespace App\Http\Controllers;
use App\Models\Dpl;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DplController extends Controller
{

    public function dpl()
    {
        $users = Auth::user();
        $admin = $users->admin;
        $mahasiswa = $users->mahasiswa;
        $dpl = $users->dpl;
       
        return view('dashboard.dpl', compact('users', 'admin', 'mahasiswa', 'dpl'));
    }
    public function getData()
    {
        $data = Dpl::all(); 
        return response()->json($data);
    }
}
