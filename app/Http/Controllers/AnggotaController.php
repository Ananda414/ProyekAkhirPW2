<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Anggota::all();
        return view('anggota/create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'username' => 'required',
            'kota_lahir' => 'required',
            'email' => 'email',
            'status' => 'required',
            'foto' => 'required'
        ]);
            $anggota = new Anggota();
            $anggota->nama_depan = $validasi['nama_depan'];
            $anggota->nama_belakang = $validasi['nama_belakang'];
            $anggota->username = $validasi['username'];
            $anggota->email = $validasi['email'];
            $anggota->jenis_kelamin = $validasi['jenis_kelamin'];
            $anggota->tanggal_lahir = $validasi['tanggal_lahir'];
            $anggota->kota_lahir = $validasi['kota_lahir'];
            $anggota->status = $validasi['status'];
            $ext = $request->foto->getClientOriginalExtension();
            $new_filename = $validasi['nama_depan']. ".".$ext;
            $request->foto->storeAs('public/images', $new_filename);
    
            
            $anggota->foto = $new_filename;
            $anggota->save();
            return redirect()->to('/listanggota')->with('success', "Data Anggota". $validasi['nama_depan']. " berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anggota $anggota)
    {
        return view('anggota.edit')->with('anggota', $anggota);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $validasi = $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'jenis_kelamin' => 'required',
            'username' => 'required',
            'tanggal_lahir' => 'required',
            'kota_lahir' => 'required',
            'email' => 'email',
            'status' => 'required',
            'foto' => 'required'
        ]);
            $anggota = Anggota::find('$id');
            $anggota->username = $validasi['username'];
            $anggota->nama_depan = $validasi['nama_depan'];
            $anggota->nama_belakang = $validasi['nama_belakang'];
            $anggota->email = $validasi['email'];
            $anggota->jenis_kelamin = $validasi['jenis_kelamin'];
            $anggota->tanggal_lahir = $validasi['tanggal_lahir'];
            $anggota->kota_lahir = $validasi['kota_lahir'];
            $anggota->status = $validasi['status'];
            $ext = $request->foto->getClientOriginalExtension();
            $new_filename = $validasi['nama_depan']. ".".$ext;
            $request->foto->storeAs('public/images', $new_filename);
    
            
            $anggota->foto = $new_filename;
            $anggota->save();
            return redirect()->to('/listanggota')->with('success', "Data Anggota". $validasi['nama_depan']. " berhasil diupdate");
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggota $anggota)
    {
        $anggota->delete();
        return response("data berhasil dihapus", 200);
    }

    public function multiDelete(Request $request) {
        Anggota::whereIn('id', $request->get('selected'))->delete();
        return response("selected anggota(s) delete successfully", 200);
    }
}
