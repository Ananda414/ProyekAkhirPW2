<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Tim;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Proyek::all();

        $tim = Tim::orderBy('nama_tim', 'ASC')->get();
        return view('proyek/create')->with('tim', $tim);
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
        $this->authorize('create', Proyek::class);

        $validasi = $request->validate([
            'nama_proyek' => 'required',
            'deskripsi_proyek' => 'nullable',
            'deadline' => 'required',
            'budget' => 'nullable',
            'tim_id' => 'required'
        ]);
        // dd($validasi);

            $proyek = new Proyek();
            $proyek->nama_proyek = $validasi['nama_proyek'];
            $proyek->deskripsi_proyek = $validasi['deskripsi_proyek'];
            $proyek->deadline = $validasi['deadline'];
            $proyek->budget = $validasi['budget'];
            $proyek->tim_id = $validasi['tim_id'];
            $proyek->save();
            return redirect()->to('/listproyek')->with('success', "Data Proyek". $validasi['nama_proyek']. " berhasil disimpan");
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
    public function edit(Proyek $proyek)
    {
        $tim = Tim::orderBy('nama_tim', 'ASC')->get();
        return view('proyek.edit')->with('proyek', $proyek)->with('tim', $tim);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('update', Proyek::class);

        $validasi = $request->validate([
            'nama_proyek' => 'required',
            'deskripsi_proyek' => 'nullable',
            'deadline' => 'required',
            'budget' => 'nullable',
            'tim_id' => 'required'
        ]);
        // dd($validasi);

            $proyek = Proyek::find($id);
            $proyek->nama_proyek = $validasi['nama_proyek'];
            $proyek->deskripsi_proyek = $validasi['deskripsi_proyek'];
            $proyek->deadline = $validasi['deadline'];
            $proyek->budget = $validasi['budget'];
            $proyek->tim_id = $validasi['tim_id'];
            $proyek->save();
            return redirect()->to('/listproyek')->with('success', "Data Proyek". $validasi['nama_proyek']. " berhasil disimpan");
  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyek $proyek)
    {
        $this->authorize('delete', Proyek::class);

        $proyek->delete();
        return response("data berhasil dihapus", 200);
    }
}
