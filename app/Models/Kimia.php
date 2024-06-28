<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Kimia extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'kimia';

    protected $fillable = [
        'nama' ,
        'volume' ,
        'jumlah' ,
        'kondisi_baik' ,
        'terpakai' ,
        'foto'
    ];

    protected $dates = [
        'created_at' ,
        'updated_at' ,
        'terakhir_dipakai'
    ];

    // public function anggota() {
    //     return $this->belongsTo(Anggota::class, 'anggota_id');
    // }
}
