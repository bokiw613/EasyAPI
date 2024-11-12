<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RincianIndikator;
use App\Models\KriteriaPerformance;

class KriteriaController extends Controller
{
    public function index()
    {
        // Mengambil data dari tabel kriteria_performance beserta rincian indikator
        $kriteria = KriteriaPerformance::with('rincianIndikator.kriteria')->get();
        
        // Mengembalikan tampilan dengan data
        return view('kriteria.index', compact('kriteria'));
    }
    public function create()
    {
        // Menampilkan formulir untuk menambahkan kriteria
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'bidang_kinerja' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'penjelasan_tujuan' => 'required|string',
            'indikator' => 'required|string|max:255',
            'teks' => 'required|string',
            'rincian_indikators'=> 'required|array',
            'rincian_indikators.*.rincian_indikator' => 'required|string',
            'rincian_indikators.*.kriteria' => 'required|string',
            'rincian_indikators.*.proses' => 'required|string',
            'rincian_indikators.*.skor' => 'required|numeric',
            'rincian_indikators.*.bukti_pendukung' => 'required|string',
            'rincian_indikators.*.penanggung_jawab' => 'required|string',
        ]);

        // Menyimpan data kriteria_performance
        $kriteria = KriteriaPerformance::create($validated);

        // Menyimpan rincian indikator
        foreach ($validated['rincian_indikators'] as $rincian) {
            $kriteria->rincianIndikators()->create($rincian);
        }

        return redirect()->route('kriteria.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kriteria = KriteriaPerformance::with('rincianIndikators')->findOrFail($id);
        return response()->json($kriteria);
    }
}
