<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Resep;
use App\Models\Tim;
use Illuminate\Http\Request;

class ResepController extends BaseController
{
    public function index()
    {
        $reseps = Resep::all();
        $success['data'] = $reseps;
        return $this->sendResponse($success, 'Data Resep.');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Resep::class);

        $validasi = $request->validate([
            'nama_resep' => 'required',
            'deskripsi_resep' => 'nullable',
            'deadline' => 'required',
            'budget' => 'nullable',
            'tim_id' => 'required'
        ]);
            $resep = new Resep();
            $resep->nama_resep = $validasi['nama_resep'];
            $resep->deskripsi_resep = $validasi['deskripsi_resep'];
            $resep->deadline = $validasi['deadline'];
            $resep->budget = $validasi['budget'];
            $resep->tim_id = $validasi['tim_id'];

            if ($resep->save()) {
                $success['data'] = $resep;
                return $this->sendResponse($success, 'Data resep berhasil disimpan');
            } else {
                return $this->sendError('Error.', ['error' => 'Data resep gagal disimpan']);
            }
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Resep::class);

        $validasi = $request->validate([
            'nama_resep' => 'required',
            'deskripsi_resep' => 'nullable',
            'deadline' => 'required',
            'budget' => 'nullable',
            'tim_id' => 'required'
        ]);
            $resep = Resep::find($id);
            $resep->nama_resep = $validasi['nama_resep'];
            $resep->deskripsi_resep = $validasi['deskripsi_resep'];
            $resep->deadline = $validasi['deadline'];
            $resep->budget = $validasi['budget'];
            $resep->tim_id = $validasi['tim_id'];

            if ($resep->save()) {
                $success['data'] = $resep;
                return $this->sendResponse($success, 'Data resep berhasil diperbarui');
            } else {
                return $this->sendError('Error.', ['error' => 'Data resep gagal diperbarui']);
            }
    }

    public function delete($id)
    {
        $this->authorize('delete', Resep::class);
        
        $resep = Resep::findOrFail($id);
        if ($resep->delete()) {
            $success['data'] = [];
            return $this->sendResponse($success, 'Data resep dengan id $id berhasil dihapus');
        } else {
            return $this->sendError('Error.', ['error' => 'Data resep gagal dihapus']);
        }
    }
}
