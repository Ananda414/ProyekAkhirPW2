<?php

namespace App\Http\Controllers;

use App\Models\Kimia;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Jobs\GenerateKimiaPDF;

class IndexKimiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 25); // Default 25 items per page
        $showAll = $request->input('show_all', false);

        if ($showAll) {
            $kimia = Kimia::all();
        } else {
            $kimia = Kimia::paginate($perPage);
        }

        return view('kimia.index')->with('kimias', $kimia);
    }
    
    public function downloadPDF()
    {
        $kimias = Kimia::all();
        $pdf = PDF::loadView('kimia.pdf', compact('kimias'));
        $tmpFile = tempnam(sys_get_temp_dir(), 'kimias_pdf_');
        $pdf->save($tmpFile);
        return response()->download($tmpFile, 'kimias.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
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
    public function edit(Kimia $kimia)
    {
        return view('kimia.edit')->with('kimia', $kimia)->with('photoName', $kimia->foto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kimia $kimia)
    {
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

            // Store the new photo in the public/images folder
            $request->foto->storeAs('public/images', $new_filename);

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
        $kimia->delete();
        return response("data berhasil dihapus", 200);
    }
}
