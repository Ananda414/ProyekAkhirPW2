<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Proyek;
use App\Models\Tim;
use Illuminate\Http\Request;

class ProyekController extends BaseController
{
    public function index()
    {
        $proyeks = Proyek::all();
        $success['data'] = $proyeks;
        return $this->sendResponse($success, 'Data Proyek.');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Proyek::class);

        $validasi = $request->validate([
            'nama_proyek' => 'required',
            'deskripsi_proyek' => 'nullable',
            'deadline' => 'required',
            'budget' => 'nullable',
            'tim_id' => 'required'
        ]);
            $proyek = new Proyek();
            $proyek->nama_proyek = $validasi['nama_proyek'];
            $proyek->deskripsi_proyek = $validasi['deskripsi_proyek'];
            $proyek->deadline = $validasi['deadline'];
            $proyek->budget = $validasi['budget'];
            $proyek->tim_id = $validasi['tim_id'];

            if ($proyek->save()) {
                $success['data'] = $proyek;
                return $this->sendResponse($success, 'Data proyek berhasil disimpan');
            } else {
                return $this->sendError('Error.', ['error' => 'Data proyek gagal disimpan']);
            }
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Proyek::class);

        $validasi = $request->validate([
            'nama_proyek' => 'required',
            'deskripsi_proyek' => 'nullable',
            'deadline' => 'required',
            'budget' => 'nullable',
            'tim_id' => 'required'
        ]);
            $proyek = Proyek::find($id);
            $proyek->nama_proyek = $validasi['nama_proyek'];
            $proyek->deskripsi_proyek = $validasi['deskripsi_proyek'];
            $proyek->deadline = $validasi['deadline'];
            $proyek->budget = $validasi['budget'];
            $proyek->tim_id = $validasi['tim_id'];

            if ($proyek->save()) {
                $success['data'] = $proyek;
                return $this->sendResponse($success, 'Data proyek berhasil diperbarui');
            } else {
                return $this->sendError('Error.', ['error' => 'Data proyek gagal diperbarui']);
            }
    }

    public function delete($id)
    {
        $this->authorize('delete', Proyek::class);
        
        $proyek = Proyek::findOrFail($id);
        if ($proyek->delete()) {
            $success['data'] = [];
            return $this->sendResponse($success, 'Data proyek dengan id $id berhasil dihapus');
        } else {
            return $this->sendError('Error.', ['error' => 'Data proyek gagal dihapus']);
        }
    }
}
