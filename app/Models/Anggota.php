<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'anggota';

    protected $fillable = [
        'nama_depan' ,
        'nama_belakang' ,
        'jenis_kelamin' ,
        'tanggal_lahir' ,
        'username' ,
        'email' ,
        'kota_lahir' ,
        'status' ,
        'foto'
    ];

    public function tim() {
        return $this ->hasMany(Tim::class);
    }
}
