<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory as FactoryHasFactory;;
use Illuminate\Database\Eloquent\Model;

class Rekrument extends Model
{
    protected $primaryKey = 'id_rekrutment';
    use FactoryHasFactory;

    protected $fillable = [
        'nama_lengkap',
        'id_lowongan',
        'email',
        'nomor_telepon',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_perkawinan',
        'jumlah_tanggungan',
        'gaji_terakhir',
        'gaji_harapan',
        'file_cv',
        'file_ktp',
        'file_surat_lamaran',
        'file_portofolio',
        'status',
    ];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan', 'id_lowongan');
    }

    protected $casts = [
        'tanggal_lahir' => 'date',
        'jumlah_tanggungan' => 'integer',
    ]; 
}
