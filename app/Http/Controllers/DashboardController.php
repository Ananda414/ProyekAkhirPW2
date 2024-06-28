<?php

namespace App\Http\Controllers;

use App\Models\Komputer;
use App\Models\Resep;
use App\Models\Kimia;
use App\Models\Simplisa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $user = auth()->user();
        $data['komputer'] = Komputer::all();
        $data['kimia'] = Kimia::all();
        $data['resep'] = Resep::all();
        $data['simplisa'] = Simplisa::all();

        $kimia_total_jumlah = Kimia::sum('jumlah');
        $komputer_total_jumlah = Komputer::sum('jumlah');
        $resep_total_jumlah = Resep::sum('jumlah');
        $simplisa_total_jumlah = Simplisa::sum('jumlah');

        $data['kimia_total_jumlah'] = $kimia_total_jumlah;
        $data['komputer_total_jumlah'] = $komputer_total_jumlah;
        $data['resep_total_jumlah'] = $resep_total_jumlah;
        $data['simplisa_total_jumlah'] = $simplisa_total_jumlah;
    
        $kimia_per_tahun = Kimia::select(DB::raw('YEAR(created_at) as year, COUNT(*) as count, SUM(jumlah) as total_jumlah'))
            ->groupBy('year')
            ->whereBetween(DB::raw('YEAR(created_at)'), [2014, 2024])
            ->get();

        $komputer_per_tahun = Komputer::select(DB::raw('YEAR(created_at) as year, COUNT(*) as count, SUM(jumlah) as total_jumlah'))
            ->groupBy('year')
            ->whereBetween(DB::raw('YEAR(created_at)'), [2014, 2024])
            ->get();

        $resep_per_tahun = Resep::select(DB::raw('YEAR(created_at) as year, COUNT(*) as count, SUM(jumlah) as total_jumlah'))
            ->groupBy('year')
            ->whereBetween(DB::raw('YEAR(created_at)'), [2014, 2024])
            ->get();

        $simplisa_per_tahun = Simplisa::select(DB::raw('YEAR(created_at) as year, COUNT(*) as count, SUM(jumlah) as total_jumlah'))
            ->groupBy('year')
            ->whereBetween(DB::raw('YEAR(created_at)'), [2014, 2024])
            ->get();
    
        $years = $kimia_per_tahun->pluck('year');
        $counts = $kimia_per_tahun->pluck('count');
        $komputer_years = $komputer_per_tahun->pluck('year');
        $komputer_counts = $komputer_per_tahun->pluck('count');
        $resep_years = $resep_per_tahun->pluck('year');
        $resep_counts = $resep_per_tahun->pluck('count');
        $simplisa_years = $simplisa_per_tahun->pluck('year');
        $simplisa_counts = $simplisa_per_tahun->pluck('count');
    
        $data['kimia_per_tahun'] = $kimia_per_tahun;
        $data['komputer_per_tahun'] = $komputer_per_tahun;
        $data['resep_per_tahun'] = $resep_per_tahun;
        $data['simplisa_per_tahun'] = $simplisa_per_tahun;
        $data['years'] = $years;
        $data['counts'] = $counts;
        $data['komputer_years'] = $komputer_years;
        $data['komputer_counts'] = $komputer_counts;
        $data['resep_years'] = $resep_years;
        $data['resep_counts'] = $resep_counts;
        $data['simplisa_years'] = $simplisa_years;
        $data['simplisa_counts'] = $simplisa_counts;
    
        return view('auth.dashboard', $data, compact('user'));
    }
}
