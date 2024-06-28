<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Kimia;
use Illuminate\Http\Request;

class KimiaController extends BaseController
{
    public function index()
    {
        $kimias = Kimia::all();
        $success['data'] = $kimias;
        return $this->sendResponse($success, 'Data Kimia.');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Kimia::class);

        $validasi = $request->validate([
            'nama_kimia' => 'required',
            'deskripsi_kimia' => 'nullable',
            'tanggal_berdiri' => 'required',
            'anggota_id' => 'required',
            'kontak_kimia' => 'required',
            'logo' => 'required'
        ]);
            $ext = $request->logo->getClientOriginalExtension();
            $new_filename = "logo-". time() . "." . $ext;
            $path = $request->logo->storeAs('public/images', $new_filename);

            $kimia = new Kimia();
            $kimia->nama_kimia = $validasi['nama_kimia'];
            $kimia->deskripsi_kimia = $validasi['deskripsi_kimia'];
            $kimia->tanggal_berdiri = $validasi['tanggal_berdiri'];
            $kimia->kontak_kimia = $validasi['kontak_kimia'];
            $kimia->anggota_id = $validasi['anggota_id'];
            $kimia->logo = $new_filename;

            if ($kimia->save()) {
                $success['data'] = $kimia;
                return $this->sendResponse($success, 'Data kimia berhasil disimpan');
            } else {
                return $this->sendError('Error.', ['error' => 'Data kimia gagal disimpan']);
            }
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Kimia::class);

        $validasi = $request->validate([
            'nama_kimia' => 'required',
            'deskripsi_kimia' => 'nullable',
            'tanggal_berdiri' => 'required',
            'anggota_id' => 'required',
            'kontak_kimia' => 'required',
            'logo' => 'required'
        ]);
            $ext = $request->logo->getClientOriginalExtension();
            $new_filename = "logo-". time() . "." . $ext;
            $path = $request->logo->storeAs('public/images', $new_filename);

            $kimia = Kimia::find($id);
            $kimia->nama_kimia = $validasi['nama_kimia'];
            $kimia->deskripsi_kimia = $validasi['deskripsi_kimia'];
            $kimia->tanggal_berdiri = $validasi['tanggal_berdiri'];
            $kimia->kontak_kimia = $validasi['kontak_kimia'];
            $kimia->anggota_id = $validasi['anggota_id'];
            $kimia->logo = $new_filename;

            if ($kimia->save()) {
                $success['data'] = $kimia;
                return $this->sendResponse($success, 'Data kimia berhasil diperbarui');
            } else {
                return $this->sendError('Error.', ['error' => 'Data kimia gagal diperbarui']);
            }
    }

    public function delete($id)
    {
        $this->authorize('delete', Kimia::class);
        
        $kimia = Kimia::findOrFail($id);
        if ($kimia->delete()) {
            $success['data'] = [];
            return $this->sendResponse($success, 'Data kimia dengan id $id berhasil dihapus');
        } else {
            return $this->sendError('Error.', ['error' => 'Data kimia gagal dihapus']);
        }
    }
}
