<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class IndexResepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 25); // Default 25 items per page
        $showAll = $request->input('show_all', false);

        if ($showAll) {
            $resep = Resep::all();
        } else {
            $resep = Resep::paginate($perPage);
        }

        return view('resep.index')->with('reseps', $resep);
    }

    public function downloadPDF()
    {
        $reseps = Resep::all();

        $pdf = PDF::loadView('resep.pdf', compact('reseps'));

        return $pdf->download('reseps.pdf');
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
        //
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
        $resep->volume = $validasi['spesifikasi'];
        $resep->jumlah = $validasi['jumlah'];
        $resep->kondisi_baik = $validasi['kondisi_baik'];
        $resep->terpakai = $validasi['terpakai'];
        $resep->save();

        // Redirect to the list of computers with a success message
        return redirect()->to('/listresep')->with('success', "Data Resep ". $validasi['nama']. " berhasil diperbarui");
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resep $resep)
    {
        $resep->delete();
        return response("data berhasil dihapus", 200);
    }
}
