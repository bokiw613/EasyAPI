<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'rincian_indikator_id',
        'kriteria',
        'penanggung_jawab',
    ];

    public function tabelRincianIndikator()
    {
        return $this->belongsTo(TabelRincianIndikator::class, 'rincian_indikator_id');
    }

    public function kriteriaDetails()
    {
        return $this->hasMany(KriteriaDetail::class);
    }
}
