<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Resep extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'resep';

    protected $fillable = [
        'nama' ,
        'spesifikasi' ,
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

    // public function tim() {
    //     return $this->belongsTo(Tim::class, 'tim_id');
    // }
}
