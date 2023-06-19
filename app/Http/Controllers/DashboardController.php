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
        $data['anggota'] = Anggota::all();
        $data['tim'] = Tim::all();
        $data['proyek'] = Proyek::all();
        $data['anggotatim'] = DB::select('SELECT a.username, COUNT(*) as jumlah
        FROM tim t
        JOIN anggota a ON t.anggota_id = a.id
        GROUP BY a.username');
        // dd($data['anggotatim']);
        return view('auth.dashboard', $data);
    }
}
