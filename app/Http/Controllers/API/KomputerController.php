<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Komputer;
use Illuminate\Http\Request;

class KomputerController extends BaseController
{
    public function index()
    {
        $komputers = Komputer::all();
        $success['data'] = $komputers;
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
    
            $komputer = new Komputer();
            $komputer->nama_depan = $validasi['nama_depan'];
            $komputer->foto = $new_filename;
            $komputer->nama_belakang = $validasi['nama_belakang'];
            $komputer->username = $validasi['username'];
            $komputer->email = $validasi['email'];
            $komputer->jenis_kelamin = $validasi['jenis_kelamin'];
            $komputer->tanggal_lahir = $validasi['tanggal_lahir'];
            $komputer->kota_lahir = $validasi['kota_lahir'];
            $komputer->status = $validasi['status'];

            if ($komputer->save()) {
                $success['data'] = $komputer;
                return $this->sendResponse($success, 'Data komputer berhasil disimpan');
            } else {
                return $this->sendError('Error.', ['error' => 'Data komputer gagal disimpan']);
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
    
            $komputer = Komputer::find($id);
            $komputer->nama_depan = $validasi['nama_depan'];
            $komputer->foto = $new_filename;
            $komputer->nama_belakang = $validasi['nama_belakang'];
            $komputer->username = $validasi['username'];
            $komputer->email = $validasi['email'];
            $komputer->jenis_kelamin = $validasi['jenis_kelamin'];
            $komputer->tanggal_lahir = $validasi['tanggal_lahir'];
            $komputer->kota_lahir = $validasi['kota_lahir'];
            $komputer->status = $validasi['status'];

            if ($komputer->save()) {
                $success['data'] = $komputer;
                return $this->sendResponse($success, 'Data komputer berhasil diperbarui');
            } else {
                return $this->sendError('Error.', ['error' => 'Data komputer gagal diperbarui']);
            }
    }

    public function delete($id)
    {
        $komputer = Komputer::findOrFail($id);
        if ($komputer->delete()) {
            $success['data'] = [];
            return $this->sendResponse($success, 'Data komputer dengan id $id berhasil dihapus');
        } else {
            return $this->sendError('Error.', ['error' => 'Data komputer gagal dihapus']);
        }
    }
}
