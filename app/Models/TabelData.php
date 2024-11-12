<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TabelData extends Model
{
    use HasFactory;

    protected $table = 'tabel_data';

    protected $fillable = [
        'bidang_kerja',
        'tujuan',
        'penjelasan',
        'indikator',
        'text',
    ];

    // Mendefinisikan relasi dengan TabelRincianIndikator
    public function rincianIndikator()
    {
        return $this->hasMany(TabelRincianIndikator::class, 'tabel_data_id');
    }
}
