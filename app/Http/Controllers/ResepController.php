<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Tim;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Resep::all();
        return view('resep/create');
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
        $this->authorize('create', Resep::class);

        $validasi = $request->validate([
            'nama' => 'required|string|max:255|unique:resep,nama,',
            'spesifikasi' => 'nullable',
            'jumlah' => 'required',
            'kondisi_baik' => 'required',
            'terpakai' => 'nullable',
            'foto' => 'required'
        ]);
            $resep = new Resep();
            $resep->nama = $validasi['nama'];
            $resep->spesifikasi = $validasi['spesifikasi'];
            $resep->jumlah = $validasi['jumlah'];
            $resep->kondisi_baik = $validasi['kondisi_baik'];
            $resep->terpakai = $validasi['terpakai'];

            $ext = $request->foto->getClientOriginalExtension();
            $new_filename = $validasi['nama']. ".".$ext;
            $request->foto->storeAs('public/images', $new_filename);
    
            if (!empty($validasi['terpakai'])) {
                $resep->terakhir_dipakai = now();
            } else {
                $resep->terakhir_dipakai = null;
            }
            
            $resep->foto = $new_filename;
            $resep->save();
            return redirect()->to('/listresep')->with('success', "Data Resep ". $validasi['nama']. " berhasil dibuat");
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
    public function edit(Resep $resep)
    {
        return view('resep.edit')->with('resep', $resep)->with('photoName', $resep->foto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resep $resep)
    {
        $this->authorize('update', Resep::class);

        $validasi = $request->validate([
            'nama' => 'required|string|max:255|unique:resep,nama,' . $resep->id,
            'spesifikasi' => 'nullable',
            'jumlah' => 'required',
            'kondisi_baik' => 'required',
            'terpakai' => 'nullable'
        ]);

        if ($resep->terpakai != $validasi['terpakai']) {
            $resep->terakhir_dipakai = now();
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
            $resep->foto = $new_filename;
        }
    
        // Save the updated record to the database
        $resep->nama = $validasi['nama'];
        $resep->spesifikasi = $validasi['spesifikasi'];
        $resep->jumlah = $validasi['jumlah'];
        $resep->kondisi_baik = $validasi['kondisi_baik'];
        $resep->terpakai = $validasi['terpakai'];
        $resep->save();
        return redirect()->to('/listresep')->with('success', "Data Resep". $validasi['nama']. " berhasil diperbarui");
  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resep $resep)
    {
        $this->authorize('delete', Resep::class);

        $resep->delete();
        return response("data berhasil dihapus", 200);
    }
}
