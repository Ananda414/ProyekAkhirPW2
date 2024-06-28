<?php

namespace App\Http\Controllers;

use App\Models\Simplisa;
use Illuminate\Http\Request;

class SimplisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Simplisa::all();
        return view('simplisa/create');
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
        $this->authorize('create', Simplisa::class);

        $validasi = $request->validate([
            'nama' => 'required|string|max:255|unique:simplisa,nama',
            'spesifikasi' => 'nullable',
            'jumlah' => 'required',
            'kondisi_baik' => 'required',
            'terpakai' => 'nullable',
            'foto' => 'required'
        ]);

            $simplisa = new Simplisa();
            $simplisa->nama = $validasi['nama'];
            $simplisa->spesifikasi = $validasi['spesifikasi'];
            $simplisa->jumlah = $validasi['jumlah'];
            $simplisa->kondisi_baik = $validasi['kondisi_baik'];
            $simplisa->terpakai = $validasi['terpakai'];

            $ext = $request->foto->getClientOriginalExtension();
            $new_filename = $validasi['nama']. ".".$ext;
            $request->foto->storeAs('public/images', $new_filename);
    
            if (!empty($validasi['terpakai'])) {
                $simplisa->terakhir_dipakai = now();
            } else {
                $simplisa->terakhir_dipakai = null;
            }
            
            $simplisa->foto = $new_filename;
            $simplisa->save();
            return redirect()->to('/listsimplisa')->with('success', "Data Simplisa ". $validasi['nama']. " berhasil dibuat");
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
    public function edit(Simplisa $simplisa)
    {       
        return view('simplisa.edit')->with('simplisa', $simplisa)->with('photoName', $simplisa->foto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Simplisa $simplisa)
    {
        $this->authorize('update', Simplisa::class);

        $validasi = $request->validate([
            'nama' => 'required|string|max:255|unique:simplisa,nama,' . $simplisa->id,
            'spesifikasi' => 'nullable',
            'jumlah' => 'required',
            'kondisi_baik' => 'required',
            'terpakai' => 'nullable'
        ]);

        if ($simplisa->terpakai != $validasi['terpakai']) {
            $simplisa->terakhir_dipakai = now();
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
            $simplisa->foto = $new_filename;
        }
    
        // Save the updated record to the database
        $simplisa->nama = $validasi['nama'];
        $simplisa->spesifikasi = $validasi['spesifikasi'];
        $simplisa->jumlah = $validasi['jumlah'];
        $simplisa->kondisi_baik = $validasi['kondisi_baik'];
        $simplisa->terpakai = $validasi['terpakai'];
        $simplisa->save();
    
        // Redirect to the list of computers with a success message
        return redirect()->to('/listsimplisa')->with('success', "Data Simplisa ". $validasi['nama']. " berhasil diperbarui");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Simplisa $simplisa)
    {
        $this->authorize('delete', Simplisa::class);

        $simplisa->delete();
        return response("data berhasil dihapus", 200);
    }
}
