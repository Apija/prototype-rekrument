<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory as FactoryHasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $primaryKey = 'id_lowongan';
    use FactoryHasFactory;

    protected $fillable = [
        'nama_lowongan',
        'jumlah_kebutuhan',
    ];

    // Relasi ke Rekrument
    public function rekruments()
    {
        return $this->hasMany(Rekrument::class, 'id_lowongan', 'id_lowongan');
    }
}