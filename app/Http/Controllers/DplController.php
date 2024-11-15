<?php

namespace App\Http\Controllers;

use App\Models\Dpl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class DplController extends Controller
{

    public function dpl()
    {
        $users = Auth::user();

        return view('informasi.dpl.dpl', compact('users'));
    }
    public function getDataDpl()
    {
        $data = Dpl::all();
        return response()->json($data);
    }

    public function downloadDataDpl()
    {

        $data = Dpl::all();


        $fileName = 'data_dpl.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['Nama Lengkap', 'Inisial', 'Gelar', 'Fakultas', 'prodi', 'email', 'Nomer Whatsapp', 'status'];

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->namaLengkap,
                    $row->inisial,
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

    public function detailDpl($namaLengkap)
    {

        $user = User::where('namaLengkap', $namaLengkap)->first();

        return view('informasi.dpl.detail_dpl', ['user' => $user]);
    }

    public function updateDetailDpl(Request $request)
    {
        $username = $request->username;
        $user = User::where('username', $username)->first();
        $user->namaLengkap = $request->namaLengkap;
        $user->save();

        $dpl = Dpl::where('username', $username)->first();
        $dpl->namaLengkap = $request->namaLengkap;
        $dpl->inisial = $request->inisial;
        $dpl->gelar = $request->gelar;
        $dpl->fakultas = $request->fakultas;
        $dpl->prodi = $request->prodi;
        $dpl->Email = $request->email;
        $dpl->nomerWhatsapp = $request->nomerWhatsapp;
        $dpl->save();

        return response()->json(['msg' => 'Data DPL Berhasil Diubah.'], 200);
    }

    public function deleteDataDpl($namaLengkap)
    {
        $user = User::where('namaLengkap', $namaLengkap)->first();
        $user->delete();

        $dpl = Dpl::where('namaLengkap', $namaLengkap)->first();
        $dpl->delete();

        return redirect()->back()->with('success', 'Data DPL Berhasil Dihapus.');
    }
}
