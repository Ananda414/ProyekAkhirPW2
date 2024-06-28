<?php

namespace App\Http\Controllers;

use App\Models\Kimia;
use Illuminate\Http\Request;

class KimiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kimia::all();
        return view('kimia/create');
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
        $this->authorize('create', Kimia::class);

        $validasi = $request->validate([
            'nama' => 'required|string|max:255|unique:kimia,nama',
            'volume' => 'nullable',
            'jumlah' => 'required',
            'kondisi_baik' => 'required',
            'terpakai' => 'nullable',
            'foto' => 'required'
        ]);

            $kimia = new Kimia();
            $kimia->nama = $validasi['nama'];
            $kimia->volume = $validasi['volume'];
            $kimia->jumlah = $validasi['jumlah'];
            $kimia->kondisi_baik = $validasi['kondisi_baik'];
            $kimia->terpakai = $validasi['terpakai'];

            $ext = $request->foto->getClientOriginalExtension();
            $new_filename = $validasi['nama']. ".".$ext;
            $request->foto->storeAs('public/assets/images/list', $new_filename);
    
            if (!empty($validasi['terpakai'])) {
                $kimia->terakhir_dipakai = now();
            } else {
                $kimia->terakhir_dipakai = null;
            }
            
            $kimia->foto = $new_filename;
            $kimia->save();
            return redirect()->to('/listkimia')->with('success', "Data Kimia ". $validasi['nama']. " berhasil dibuat");
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
    public function edit(Kimia $kimia)
    {       
        return view('kimia.edit')->with('kimia', $kimia)->with('photoName', $kimia->foto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kimia $kimia)
    {
        $this->authorize('update', Kimia::class);

        $validasi = $request->validate([
            'nama' => 'required|string|max:255|unique:kimia,nama,' . $kimia->id,
            'volume' => 'nullable',
            'jumlah' => 'required',
            'kondisi_baik' => 'required',
            'terpakai' => 'nullable'
        ]);

        if ($kimia->terpakai != $validasi['terpakai']) {
            $kimia->terakhir_dipakai = now();
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
    
            // Store the new photo in the public/assets/images/list folder
            $request->foto->storeAs('public/assets/images/list', $new_filename);
    
            // Update the photo field in the database with the new filename
            $kimia->foto = $new_filename;
        }
    
        // Save the updated record to the database
        $kimia->nama = $validasi['nama'];
        $kimia->volume = $validasi['volume'];
        $kimia->jumlah = $validasi['jumlah'];
        $kimia->kondisi_baik = $validasi['kondisi_baik'];
        $kimia->terpakai = $validasi['terpakai'];
        $kimia->save();
    
        // Redirect to the list of computers with a success message
        return redirect()->to('/listkimia')->with('success', "Data Kimia ". $validasi['nama']. " berhasil diperbarui");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kimia $kimia)
    {
        $this->authorize('delete', Kimia::class);

        $kimia->delete();
        return response("data berhasil dihapus", 200);
    }
}
