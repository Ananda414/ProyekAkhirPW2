<?php

namespace App\Http\Controllers;

use App\Models\Komputer;
use Illuminate\Http\Request;

class KomputerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Komputer::all();
        return view('komputer/create');
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
        $this->authorize('create', Komputer::class);

        $validasi = $request->validate([
            'nama' => 'required|string|max:255|unique:komputer,nama,',
            'jumlah' => 'required',
            'kondisi_baik' => 'required',
            'terpakai' => 'nullable',
            'foto' => 'required'
        ]);
            $komputer = new Komputer();
            $komputer->nama = $validasi['nama'];
            $komputer->jumlah = $validasi['jumlah'];
            $komputer->kondisi_baik = $validasi['kondisi_baik'];
            $komputer->terpakai = $validasi['terpakai'];

            $ext = $request->foto->getClientOriginalExtension();
            $new_filename = $validasi['nama']. ".".$ext;
            $request->foto->storeAs('public/images', $new_filename);
    
            if (!empty($validasi['terpakai'])) {
                $komputer->terakhir_dipakai = now();
            } else {
                $komputer->terakhir_dipakai = null;
            }
            
            $komputer->foto = $new_filename;
            $komputer->save();
            return redirect()->to('/listkomputer')->with('success', "Data Komputer ". $validasi['nama']. " berhasil dibuat");
    }

    /**
     * Display the specified resource.
     */
    public function show(Komputer $komputer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Komputer $komputer)
    {
        return view('komputer.edit')->with('komputer', $komputer)->with('photoName', $komputer->foto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Komputer $komputer)
    {
        $this->authorize('update', Komputer::class);

        $validasi = $request->validate([
            'nama' => 'required|string|max:255|unique:komputer,nama,' . $komputer->id,
            'jumlah' => 'required',
            'kondisi_baik' => 'required',
            'terpakai' => 'nullable'
        ]);

        if ($komputer->terpakai != $validasi['terpakai']) {
            $komputer->terakhir_dipakai = now();
        }
    
        // Check if a new photo has been uploaded
        if ($request->hasFile('foto')) {
            // Validate the new photo
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            // Get the extension of the new photo
            $ext = $request->foto->getClientOriginalExtension();
    
            // Generate a new filename for the new photo
            $new_filename = $validasi['nama']. ".".$ext;
    
            // Store the new photo in the public/images folder
            $request->foto->storeAs('public/images', $new_filename);
    
            // Update the photo field in the database with the new filename
            $komputer->foto = $new_filename;
        }
    
        // Save the updated record to the database
        $komputer->nama = $validasi['nama'];
        $komputer->jumlah = $validasi['jumlah'];
        $komputer->kondisi_baik = $validasi['kondisi_baik'];
        $komputer->terpakai = $validasi['terpakai'];
        $komputer->save();
    
        // Redirect to the list of computers with a success message
        return redirect()->to('/listkomputer')->with('success', "Data Komputer ". $validasi['nama']. " berhasil diperbarui");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komputer $komputer)
    {
        $komputer->delete();
        return response("data berhasil dihapus", 200);
    }
}
