<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function mahasiswa()
    {
        return view('informasi.mahasiswa.mahasiswa', compact('users'));
    }
    public function getDataMahasiswa()
    {
        $data = Mahasiswa::all();
        return response()->json($data);
    }
}
