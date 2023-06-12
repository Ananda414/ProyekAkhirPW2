<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tim')->insert([
            [
            'id' => Str::uuid(),
            'nama_anggota' => 'Ananda',
            'usia' => '33',
            'kota_lahir' => 'Palembang',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        [
            'id' => Str::uuid(),
            'nama_anggota' => 'Thomas',
            'usia' => '31',
            'kota_lahir' => 'Lampung',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],
    ]);
    }
}
