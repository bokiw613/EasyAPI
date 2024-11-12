<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelRincianIndikator extends Model
{
    use HasFactory;

    protected $table = 'tabel_rincian_indikator';

    protected $fillable = [
        'tabel_data_id',
        'rincian_indikator',
    ];

    // Mendefinisikan relasi dengan kriteria
    public function kriterias()
    {
        return $this->hasMany(Kriteria::class, 'rincian_indikator_id');
    }

    // Mendefinisikan relasi dengan TabelData
    public function tabelData()
    {
        return $this->belongsTo(TabelData::class, 'tabel_data_id');
    }
}
