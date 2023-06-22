<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Tim;
use Illuminate\Http\Request;

class TimController extends BaseController
{
    public function index()
    {
        $tims = Tim::all();
        $success['data'] = $tims;
        return $this->sendResponse($success, 'Data Tim.');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Tim::class);

        $validasi = $request->validate([
            'nama_tim' => 'required',
            'deskripsi_tim' => 'nullable',
            'tanggal_berdiri' => 'required',
            'anggota_id' => 'required',
            'kontak_tim' => 'required',
            'logo' => 'required'
        ]);
            $ext = $request->logo->getClientOriginalExtension();
            $new_filename = "logo-". time() . "." . $ext;
            $path = $request->logo->storeAs('public/images', $new_filename);

            $tim = new Tim();
            $tim->nama_tim = $validasi['nama_tim'];
            $tim->deskripsi_tim = $validasi['deskripsi_tim'];
            $tim->tanggal_berdiri = $validasi['tanggal_berdiri'];
            $tim->kontak_tim = $validasi['kontak_tim'];
            $tim->anggota_id = $validasi['anggota_id'];
            $tim->logo = $new_filename;

            if ($tim->save()) {
                $success['data'] = $tim;
                return $this->sendResponse($success, 'Data tim berhasil disimpan');
            } else {
                return $this->sendError('Error.', ['error' => 'Data tim gagal disimpan']);
            }
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Tim::class);

        $validasi = $request->validate([
            'nama_tim' => 'required',
            'deskripsi_tim' => 'nullable',
            'tanggal_berdiri' => 'required',
            'anggota_id' => 'required',
            'kontak_tim' => 'required',
            'logo' => 'required'
        ]);
            $ext = $request->logo->getClientOriginalExtension();
            $new_filename = "logo-". time() . "." . $ext;
            $path = $request->logo->storeAs('public/images', $new_filename);

            $tim = Tim::find($id);
            $tim->nama_tim = $validasi['nama_tim'];
            $tim->deskripsi_tim = $validasi['deskripsi_tim'];
            $tim->tanggal_berdiri = $validasi['tanggal_berdiri'];
            $tim->kontak_tim = $validasi['kontak_tim'];
            $tim->anggota_id = $validasi['anggota_id'];
            $tim->logo = $new_filename;

            if ($tim->save()) {
                $success['data'] = $tim;
                return $this->sendResponse($success, 'Data tim berhasil diperbarui');
            } else {
                return $this->sendError('Error.', ['error' => 'Data tim gagal diperbarui']);
            }
    }

    public function delete($id)
    {
        $this->authorize('delete', Tim::class);
        
        $tim = Tim::findOrFail($id);
        if ($tim->delete()) {
            $success['data'] = [];
            return $this->sendResponse($success, 'Data tim dengan id $id berhasil dihapus');
        } else {
            return $this->sendError('Error.', ['error' => 'Data tim gagal dihapus']);
        }
    }
}
