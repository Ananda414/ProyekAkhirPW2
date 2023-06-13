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
        DB::table('anggota')->insert([
            [
            'id' => Str::uuid(),
            'nama_depan' => 'Ananda',
            'nama_belakang' => 'Wijaya',
            'tanggal_lahir' => '05/20/2003',
            'username' => 'Ananda414',
            'email' => 'wijaya@gmail.com',
            'kota_lahir' => 'Palembang',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        [
            'id' => Str::uuid(),
            'nama_depan' => 'Thomas',
            'nama_belakang' => 'Setiawan',
            'tanggal_lahir' => '11/24/2003',
            'username' => 'Thomas123',
            'email' => 'thomas@gmail.com',
            'kota_lahir' => 'Palembang',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],
    ]);
    }
}
