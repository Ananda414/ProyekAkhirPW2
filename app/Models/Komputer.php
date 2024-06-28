<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Komputer extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'komputer';
    protected $fillable = [
        'nama' ,
        'jumlah' ,
        'kondisi_baik' ,
        'foto' ,
        'terpakai'
    ];

    protected $dates = [
        'created_at' ,
        'updated_at' ,
        'terakhir_dipakai'
    ];

    // public function tim() {
    //     return $this -> hasMany(Tim::class);
    // }
}
