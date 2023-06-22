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
        $user = auth()->user();
        $data['anggota'] = Anggota::all();
        $data['tim'] = Tim::all();
        $data['proyek'] = Proyek::all();
        $data['proyektim'] = DB::select('SELECT t.nama_tim, COUNT(*) as jumlahProyek
        FROM proyek p
        JOIN tim t ON p.tim_id = t.id
        GROUP BY t.nama_tim');
        // dd($data['anggotatim']);
        return view('auth.dashboard', $data, compact('user'));
    }
}
