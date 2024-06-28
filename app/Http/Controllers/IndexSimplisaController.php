<?php

namespace App\Http\Controllers;

use App\Models\Simplisa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class IndexSimplisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 25); // Default 25 items per page
        $showAll = $request->input('show_all', false);

        if ($showAll) {
            $simplisa = Simplisa::all();
        } else {
            $simplisa = Simplisa::paginate($perPage);
        }

        return view('simplisa.index')->with('simplisas', $simplisa);
    }

    public function downloadPDF()
    {
        $simplisas = Simplisa::all();

        $pdf = PDF::loadView('simplisa.pdf', compact('simplisas'));

        return $pdf->download('simplisas.pdf');
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
    public function edit(Simplisa $simplisa)
    {
        return view('simplisa.edit')->with('simplisa', $simplisa)->with('photoName', $simplisa->foto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Simplisa $simplisa)
    {
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
        $simplisa->delete();
        return response("data berhasil dihapus", 200);
    }
}
