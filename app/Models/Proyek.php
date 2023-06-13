<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'proyek';

    protected $fillable = [
        'nama_proyek' ,
        'deskripsi_proyek' ,
        'deadline' ,
        'budget' ,
        'tim_id'
    ];

    public function tim() {
        return $this->belongsTo(Tim::class, 'tim_id');
    }
}
