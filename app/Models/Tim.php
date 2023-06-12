<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tim extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tim';

    protected $fillable = [
        'nama_tim' ,
        'deskripsi_tim' ,
        'tanggal_berdiri' ,
        'anggota_id' ,
        'logo' ,
        'kontak_tim'
    ];

    public function anggota() {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}
