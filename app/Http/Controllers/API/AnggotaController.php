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
            'nama_belakang' => 'nullable',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'username' => 'required',
            'kota_lahir' => 'required',
            'email' => 'email',
            'status' => 'required',
            'foto' => 'required|file|image|max:5000'
        ]);
            $ext = $request->foto->getClientOriginalExtension();
            $new_filename = "foto-". time() . "." . $ext;
            $path = $request->foto->storeAs('public/images', $new_filename);
    
            $anggota = new Anggota();
            $anggota->nama_depan = $validasi['nama_depan'];
            $anggota->foto = $new_filename;
            $anggota->nama_belakang = $validasi['nama_belakang'];
            $anggota->username = $validasi['username'];
            $anggota->email = $validasi['email'];
            $anggota->jenis_kelamin = $validasi['jenis_kelamin'];
            $anggota->tanggal_lahir = $validasi['tanggal_lahir'];
            $anggota->kota_lahir = $validasi['kota_lahir'];
            $anggota->status = $validasi['status'];

            if ($anggota->save()) {
                $success['data'] = $anggota;
                return $this->sendResponse($success, 'Data anggota berhasil disimpan');
            } else {
                return $this->sendError('Error.', ['error' => 'Data anggota gagal disimpan']);
            }
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'nama_depan' => 'required|min:5|max:15',
            'nama_belakang' => 'nullable',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'username' => 'required',
            'kota_lahir' => 'required',
            'email' => 'email',
            'status' => 'required',
            'foto' => 'required|file|image|max:5000'
        ]);
            $ext = $request->foto->getClientOriginalExtension();
            $new_filename = "foto-". time() . "." . $ext;
            $path = $request->foto->storeAs('public/images', $new_filename);
    
            $anggota = Anggota::find($id);
            $anggota->nama_depan = $validasi['nama_depan'];
            $anggota->foto = $new_filename;
            $anggota->nama_belakang = $validasi['nama_belakang'];
            $anggota->username = $validasi['username'];
            $anggota->email = $validasi['email'];
            $anggota->jenis_kelamin = $validasi['jenis_kelamin'];
            $anggota->tanggal_lahir = $validasi['tanggal_lahir'];
            $anggota->kota_lahir = $validasi['kota_lahir'];
            $anggota->status = $validasi['status'];

            if ($anggota->save()) {
                $success['data'] = $anggota;
                return $this->sendResponse($success, 'Data anggota berhasil diperbarui');
            } else {
                return $this->sendError('Error.', ['error' => 'Data anggota gagal diperbarui']);
            }
    }

    public function delete($id)
    {
        $anggota = Anggota::findOrFail($id);
        if ($anggota->delete()) {
            $success['data'] = [];
            return $this->sendResponse($success, 'Data anggota dengan id $id berhasil dihapus');
        } else {
            return $this->sendError('Error.', ['error' => 'Data anggota gagal dihapus']);
        }
    }
}
