<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MahasiswaController extends Controller
{
    public function mahasiswa()
    {
        return view('informasi.mahasiswa.mahasiswa');
    }

    public function getDataMahasiswa()
    {
        $data = Mahasiswa::all();
        return response()->json($data);
    }

    public function downloadDataMahasiswa()
    {

        $data = Mahasiswa::all();


        $fileName = 'data_mahasiswa.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['Nama Lengkap', 'NPM', 'Fakultas', 'prodi', 'email', 'Nomer Whatsapp', 'status'];

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->namaLengkap,
                    $row->npm,
                    $row->gelar,
                    $row->fakultas,
                    $row->prodi,
                    $row->email,
                    $row->nomerWhatsapp,
                    $row->status,
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function detailMahasiswa($namaLengkap)
    {

        $user = User::where('namaLengkap', $namaLengkap)->first();

        return view('informasi.mahasiswa.detail_mahasiswa', ['user' => $user]);
    }

    public function updateDetailMahasiswa(Request $request)
    {
        $username = $request->username;
        $user = User::where('username', $username)->first();
        $user->namaLengkap = $request->namaLengkap;
        $user->save();

        $mahasiswa = Mahasiswa::where('username', $username)->first();
        $mahasiswa->namaLengkap = $request->namaLengkap;
        $mahasiswa->npm = $request->npm;
        $mahasiswa->fakultas = $request->fakultas;
        $mahasiswa->prodi = $request->prodi;
        $mahasiswa->Email = $request->email;
        $mahasiswa->nomerWhatsapp = $request->nomerWhatsapp;
        $mahasiswa->save();

        return response()->json(['msg' => 'Data Mahasiswa Berhasil Diubah.'], 200);
    }

    public function deleteDataMahasiswa($namaLengkap)
    {
        $user = User::where('namaLengkap', $namaLengkap)->first();
        $user->delete();

        $dpl = Mahasiswa::where('namaLengkap', $namaLengkap)->first();
        $dpl->delete();

        return redirect()->back()->with('success', 'Data DPL Berhasil Dihapus.');
    }

    public function searchDataMahasiswa(Request $request)
    {
        $keyword = $request->get('keyword');
        $results = Mahasiswa::where('namaLengkap', 'LIKE', '%' . $keyword . '%') 
                    ->orWhere('npm', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('fakultas', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('prodi', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('nomerWhatsapp', 'LIKE', '%' . $keyword . '%')
                    ->get();

        return response()->json($results);
    }
}
