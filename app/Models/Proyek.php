<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'proyek';

    public function tim() {
        return $this->belongsTo(Tim::class, 'tim_id');
    }
}
