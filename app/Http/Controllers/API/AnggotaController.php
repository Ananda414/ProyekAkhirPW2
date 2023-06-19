<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends BaseController
{
    public function index()
    {
        $anggotas = Anggota::all();
        $success['data'] = $anggotas;
        return $this->sendResponse($success, 'Data angota.');
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_depan' => 'required|min:5|max:15',
            // 'nama_belakang' => 'required',
            // 'jenis_kelamin' => 'required',
            // 'tanggal_lahir' => 'required',
            // 'username' => 'required',
            // 'kota_lahir' => 'required',
            // 'email' => 'email',
            // 'status' => 'required',
            'foto' => 'required|file|image|max:5000'
        ]);
            // $anggota->nama_belakang = $validasi['nama_belakang'];
            // $anggota->username = $validasi['username'];
            // $anggota->email = $validasi['email'];
            // $anggota->jenis_kelamin = $validasi['jenis_kelamin'];
            // $anggota->tanggal_lahir = $validasi['tanggal_lahir'];
            // $anggota->kota_lahir = $validasi['kota_lahir'];
            // $anggota->status = $validasi['status'];
            $ext = $request->foto->getClientOriginalExtension();
            $new_filename = "foto-". time() . "." . $ext;
            $path = $request->foto->storeAs('public/images', $new_filename);
    
            $anggota = new Anggota();
            $anggota->nama_depan = $validasi['nama_depan'];
            $anggota->foto = $new_filename;

            if ($anggota->save()) {
                $success['data'] = $anggota;
                return $this->sendResponse($success, 'Data anggota berhasil disimpan');
            } else {
                return $this->sendError('Error.', ['error' => 'Data anggota gagal disimpan']);
            }
    }
}
