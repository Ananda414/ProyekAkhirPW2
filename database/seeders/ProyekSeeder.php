<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProyekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tim')->insert([
            [
            'id' => Str::uuid(),
            'nama_proyek' => 'Software Admin',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        [
            'id' => Str::uuid(),
            'nama_proyek' => 'Aplikasi To-Do List',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],
    ]);
    }
}
