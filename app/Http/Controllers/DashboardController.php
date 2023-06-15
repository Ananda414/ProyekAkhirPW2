<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Proyek;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        // $data['anggota'] = Anggota::all();
        // $data['tim'] = Tim::all();
        // $data['proyek'] = Proyek::all();
        // $data['anggota_prodi'] = DB::select('SELECT p.nama_prodi, COUNT(*) as jumlah
        // FROM mahasiswa m
        // JOIN prodi p ON m.prodi_id = p.id
        // GROUP BY p.nama_prodi');
        // dd($data['mahasiswaprodi']);
        // return view('dashboard', $data);
    }
}
