<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TabelData;
use App\Models\TabelRincianIndikator;
use App\Models\Kriteria;
use App\Models\KriteriaDetail;
use Carbon\Carbon;
use Faker\Provider\Base;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TabelDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TabelData::all(); //Ambil Semua data dari Tabel Data
        return view('data.index', compact('data')); // Kirim data ketampilan
    }

    public function __construct()
    {
        // Terapkan middleware untuk cek izin pada metode tertentu
        $this->middleware('check.permission:data.view')->only('index', 'show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->input('rincianIndikator'));
        // dd($request->all());
        
        Log::info('Data yang diterima:', $request->all());

        $validator = Validator::make($request->all(), [
            'bidang_kerja' => 'required|string',
            'tujuan' => 'required|string',
            'penjelasan' => 'required|string',
            'indikator' => 'required|string',
            'text' => 'required|string',
            'rincianIndikator' => 'required|array',
            'rincianIndikator.*.rincian_indikator' => 'required|string',
            'rincianIndikator.*.kriteria' => 'required|array',
            'rincianIndikator.*.kriteria.*' => 'required|string',
            'rincianIndikator.*.proses' => 'required|array',
            'rincianIndikator.*.proses.*.*' => 'required|string',
            'rincianIndikator.*.skor' => 'required|array',
            'rincianIndikator.*.skor.*.*' => 'required|string',
            'rincianIndikator.*.bukti.*.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'rincianIndikator.*.nama_file.*.*' => 'required_with:rincianIndikator.*.bukti.*.*|string',
            'rincianIndikator.*.penanggung_jawab.*.*' => 'required|string',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // Log::info('Data yang telah divalidasi:', $validatedData);

        DB::beginTransaction();
        try {
            $data = TabelData::create($request->except('rincianIndikator'));
            
            foreach ($request->rincianIndikator as $rincian) {
            
                $rincianIndikator = TabelRincianIndikator::create([
                    'tabel_data_id' => $data->id,
                    'rincian_indikator' => $rincian['rincian_indikator'],
                ]);
                
                foreach ($rincian['kriteria'] as $kriteriaIndex => $kriteria) {
                    $penanggungJawab = $rincian['penanggung_jawab'][$kriteriaIndex] ?? null;

                    $kriteriaBaru = Kriteria::create([
                        'rincian_indikator_id' => $rincianIndikator->id,
                        'kriteria' => $kriteria,
                        'penanggung_jawab' => $penanggungJawab,
                    ]);

                    $dataToInsert = []; 

                    // Ambil proses, skor, bukti
                    $prosesItems = $rincian['proses'][$kriteriaIndex] ?? [];
                    $skorItems = $rincian['skor'][$kriteriaIndex] ?? [];
                    $buktiFiles = $rincian['bukti'][$kriteriaIndex] ?? [];
                    $namaFiles = $rincian['nama_file'][$kriteriaIndex] ?? [];

                    foreach ($prosesItems as $itemIndex => $prosesItem) {
                        $buktiPath = [];
                        
                        if (isset($buktiFiles[$itemIndex]) && is_array($buktiFiles[$itemIndex])) {
                            foreach ($buktiFiles[$itemIndex] as $fileIndex => $file) {
                                if ($file instanceof \Illuminate\Http\UploadedFile) {
                                    // Menggunakan nama file dari input atau memberi nama default
                                    $fileName = $namaFiles[$itemIndex][$fileIndex] ?? 'default_filename_' . time() . '.' . $file->getClientOriginalExtension();
                                    
                                    // Simpan file di 'public/upload/bukti' dan dapatkan path
                                    $path = $file->storeAs('public/upload/bukti', $fileName);
                                    
                                    // Tambahkan path ke array
                                    $buktiPath[] = $path;
                                }
                            }
                        }
                        if (empty($buktiPath)) {
                            $fileName = 'default_filename_' . time() . '.pdf'; // Menggunakan nama file default jika tidak ada file
                            $buktiPath[] = 'public/upload/bukti/' . $fileName; // Menyimpan file default path
                        }
                         

                        $buktiPathString = implode(',', $buktiPath);
                            
                        // Tambahkan data ke array untuk batch insert
                        $dataToInsert[] = [
                            'kriteria_id' => $kriteriaBaru->id,
                            'proses' => $prosesItem,
                            'skor' => $skorItems[$itemIndex] ?? null,
                            'bukti' => $buktiPathString,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                
                    // Melakukan batch insert ke database
                    KriteriaDetail::insert($dataToInsert);
                }
            }

            DB::commit();
            return redirect()->route('data.index')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Terjadi kesalahan saat menyimpan data:', ['error' => $e->getMessage()]);
            return redirect()->route('data.create')->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }

    
        // $buktiPaths sekarang berisi jalur dari semua file yang berhasil diunggah
        // Lakukan operasi penyimpanan data ke database atau tindakan lain yang diperlukan
    
        return redirect()->route('data.index')->with('success', 'Data berhasil disimpan');
    }


        //Redirect ke halaman tertentu setelah menimpan data
        // return redirect()->route('data.index')->with('success','Data berhasil disimpan');
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $data = TabelData::with(['rincianIndikator.kriterias.kriteriaDetails'])->findOrFail($id);

        return view('data.show', ['data' => $data]); // Kirim data ke tampilan detail
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = TabelData::with('rincianIndikator.kriterias.kriteriaDetails')->findOrFail($id);
        return view('data.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // dd($request->file());
        // Validasi data utama
        $validator = Validator::make($request->all(), [
            'bidang_kerja' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'penjelasan' => 'required|string|max:255',
            'indikator' => 'required|string|max:255',
            'text' => 'required|string',
            'rincianIndikator' => 'required|array',
            'rincianIndikator.*.rincian_indikator' => 'required|string|max:255',
            'rincianIndikator.*.kriteria' => 'required|array',
            'rincianIndikator.*.kriteria.*.kriteria' => 'required|string|max:255', // Nama kriteria
            'rincianIndikator.*.kriteria.*.proses' => 'required|array', // Proses harus array
            'rincianIndikator.*.kriteria.*.proses.*' => 'required|string|max:255', // Setiap proses
            'rincianIndikator.*.kriteria.*.skor' => 'required|array', // Skor harus array
            'rincianIndikator.*.kriteria.*.skor.*' => 'required|string|max:255', // Setiap skor
            'rincianIndikator.*.kriteria.*.bukti' => 'nullable|array',
            'rincianIndikator.*.kriteria.*.bukti.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'rincianIndikator.*.kriteria.*.penanggung_jawab' => 'required|array|max:255',
            'rincianIndikator.*.kriteria.*.penanggung_jawab' => 'required|string', // Validasi penanggung jawab
        ]);

        if ($validator->fails()) {
            return redirect()->route('data.edit', $id)
                             ->withErrors($validator)
                             ->withInput();
        }
    
        $validatedData = $validator->validated();

        DB::beginTransaction();
        try {
            // Update data utama
            $data = TabelData::findOrFail($id);
            $data->update($validatedData);

            // Hapus rincian indikator lama
            TabelRincianIndikator::where('tabel_data_id', $data->id)->delete();

            // Simpan rincian indikator baru
            foreach ($validatedData['rincianIndikator'] as $rincianIndex => $rincian) {
                $rincianIndikator = TabelRincianIndikator::create([
                    'tabel_data_id' => $data->id,
                    'rincian_indikator' => $rincian['rincian_indikator'],
                ]);
                
                // Simpan kriteria yang terkait
                foreach ($rincian['kriteria'] as $kriteriaIndex => $kriteria) {

                    // Simpan data Kriteria dan penanggung jawab
                    $kriteriaModel = Kriteria::create([
                        'rincian_indikator_id' => $rincianIndikator->id,
                        'kriteria' => $kriteria['kriteria'],
                        'penanggung_jawab' => $kriteria['penanggung_jawab'], // Menyimpan penanggung jawab di tabel Kriteria
                    ]);

                    // Simpan bukti
                    $buktiPaths = [];
                    $buktiFiles = $request->file("rincianIndikator.$rincianIndex.kriteria.$kriteriaIndex.bukti") ?? [];

                    foreach ($buktiFiles as $fileIndex => $file) {
                        if ($file instanceof \Illuminate\Http\UploadedFile) {
                            $filename = 'file_' . time() . '_' . $fileIndex . '_' . $file->getClientOriginalName();
                            $buktiPaths[] = $file->storeAs('public/upload/bukti', $filename);
                        } else {
                            Log::warning('File bukti tidak valid atau tidak terdeteksi');
                        }
                    }

                    // Cek jika $buktiPaths berisi data
                    if (empty($buktiPaths)) {
                        Log::warning('Tidak ada file bukti yang berhasil disimpan');
                    }

                    // Simpan KriteriaDetail
                    foreach ($kriteria['proses'] as $prosesIndex => $proses) {
                        $data = [
                            'kriteria_id' => $kriteriaModel->id,
                            'proses' => $proses,
                            'skor' => $kriteria['skor'][$prosesIndex] ?? null,
                            'bukti' => $buktiPaths[$prosesIndex] ?? null, // Menggunakan path yang disimpan
                        ];

                        // Log data sebelum disimpan untuk debugging
                        Log::info('Menyimpan KriteriaDetail', $data);

                        $kriteriaDetail = KriteriaDetail::create($data);

                        // Cek jika penyimpanan berhasil
                        if (!$kriteriaDetail) {
                            Log::error('Gagal menyimpan KriteriaDetail', $data);
                        }
                    }

                }
            }

            DB::commit();
            return redirect()->route('data.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Terjadi kesalahan saat memperbarui data:', ['error' => $e->getMessage()]);
            return redirect()->route('data.edit', $id)->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
        }

        dd($data);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TabelData::findOrFail($id);
        $data->rincianIndikator()->delete(); // Hapus rincian indikator terkait
        $data->delete(); // Hapus data utama

        // Redirect ke halaman tertentu setelah menghapus data
        return redirect()->route('data.index')->with('success', 'Data berhasil dihapus');
    }

    public function showFile($filename)
    {
        // Tentukan jalur file
        $path = storage_path('app/public/upload/bukti' . $filename);
    
        // Periksa apakah file tersebut ada
        if (!file_exists($path)) {
            return response()->file($path);
        } else {
            abort(404, 'File tidak ditemukan');
        }
        
    }
    

}
