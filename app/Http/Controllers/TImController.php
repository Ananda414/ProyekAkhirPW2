<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Tim;
use Illuminate\Http\Request;

class TImController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tim = Tim::all();

        $anggota = Anggota::orderBy('username', 'ASC')->get();
        return view('tim/create', compact('tim'))->with('anggota', $anggota);
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
        $this->authorize('create', Tim::class);

        $validasi = $request->validate([
            'nama_tim' => 'required',
            'deskripsi_tim' => 'nullable',
            'tanggal_berdiri' => 'required',
            'anggota_id' => 'required',
            'logo' => 'required',
            'kontak_tim' => 'required'
        ]);
        // dd($validasi);
            $tim = new Tim();
            $tim->nama_tim = $validasi['nama_tim'];
            $tim->deskripsi_tim = $validasi['deskripsi_tim'];
            $tim->tanggal_berdiri = $validasi['tanggal_berdiri'];
            $tim->kontak_tim = $validasi['kontak_tim'];
            $tim->anggota_id = $validasi['anggota_id'];
            $ext = $request->logo->getClientOriginalExtension();
            $new_filename = $validasi['nama_tim']. ".".$ext;
            $request->logo->storeAs('public/images', $new_filename);
    
            $tim->logo = $new_filename;
            $tim->save();
            return redirect()->to('/listim')->with('success', "Data Tim". $validasi['nama_tim']. " berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tim $tim)
    {       
        $anggota = Anggota::orderBy('username', 'ASC')->get();
        return view('tim.edit')->with('tim', $tim)->with('anggota', $anggota);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('update', Tim::class);

        $validasi = $request->validate([
            'nama_tim' => 'required',
            'deskripsi_tim' => 'nullable',
            'tanggal_berdiri' => 'required',
            'anggota_id' => 'required',
            'logo' => 'required',
            'kontak_tim' => 'required'
        ]);
        // dd($validasi);
            $tim = Tim::find($id);
            $tim->nama_tim = $validasi['nama_tim'];
            $tim->deskripsi_tim = $validasi['deskripsi_tim'];
            $tim->tanggal_berdiri = $validasi['tanggal_berdiri'];
            $tim->kontak_tim = $validasi['kontak_tim'];
            $tim->anggota_id = $validasi['anggota_id'];
            $ext = $request->logo->getClientOriginalExtension();
            $new_filename = $validasi['nama_tim']. ".".$ext;
            $request->logo->storeAs('public/images', $new_filename);
    
            $tim->logo = $new_filename;
            $tim->save();
            return redirect()->to('/listim')->with('success', "Data Tim". $validasi['nama_tim']. " berhasil disimpan");
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tim $tim)
    {
        $this->authorize('delete', Tim::class);

        $tim->delete();
        return response("data berhasil dihapus", 200);
    }
}
