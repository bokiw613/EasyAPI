<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'kriteria_id',
        'proses',
        'skor',
        'bukti',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class); 
    }
}
