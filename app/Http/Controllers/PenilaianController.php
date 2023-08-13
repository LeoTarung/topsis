<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\nilaiQiModel;
use App\Models\PenilaianModel;
use App\Models\subKriteriaModel;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;

class PenilaianController extends Controller
{
    // public function index()
    // {
    //     $kriteria = KriteriaModel::all();
    //     $alt = AlternatifModel::all()->sortBy('urutan');
    //     foreach ($alt as $key) {
    //         $alternatif[] = $key;
    //     }
    //     // dd($alternatif);
    //     $subKriteria = subKriteriaModel::all();
    //     $penilaian = PenilaianModel::all();

    //     // dd($subrelation);
    //     $kriteriaCount = KriteriaModel::count();
    //     $alternatifCount = AlternatifModel::count();
    //     // dd($subKriteria);

    //     for ($i = 0; $i < $kriteriaCount; $i++) {
    //         ${'kriteria' . $i} = $kriteria->get($i);
    //         $kriteriaJenis[] =  ${'kriteria' . $i}->jenis_kriteria;
    //     }

    //     for ($i = 0; $i < $kriteriaCount; $i++) {
    //         ${'kriteria' . $i} = $kriteria->get($i);
    //         $kriteriaKode[] =  ${'kriteria' . $i}->kode_kriteria;
    //     }

    //     for ($i = 0; $i < $alternatifCount; $i++) {
    //         ${'alternatif' . $i} = $alternatif[$i];
    //         $alternatifJenis[] =  ${'alternatif' . $i}->nama;
    //     }

    //     for ($i = 0; $i < $alternatifCount; $i++) {
    //         ${'alternatif' . $i} =  $alternatif[$i];
    //         $alternatifKode[] =  ${'alternatif' . $i}->kode_alternatif;
    //     }
    //     return view('penilaian', [
    //         'kriteria' => $kriteriaJenis,
    //         'kriteriaCount' => $kriteriaCount,
    //         'kriteriaKode' => $kriteriaKode,
    //         'penilaian' => $penilaian,

    //         'alternatif' => $alternatifJenis,
    //         'alternatifCount' => $alternatifCount,
    //         'alternatifKode' => $alternatifKode,
    //         'subKriteria' => $subKriteria
    //     ]);
    // }

    public function tambahPenilaian(Request $request)
    {
        for ($i = 1; $i <=  $kriteriaCount = KriteriaModel::count(); $i++) {
            // ${'nilai' . $i} = subKriteriaModel::where('range', $request->{'kriteria' . $i})->first();
            PenilaianModel::create([
                'kode_alternatif' => $request->kode_alternatif_penilaian,
                'kode_kriteria' => 'C' . $i,
                'nilai' => $request->{'kriteria' . $i},
                // 'sub_kriteria' =>  ${'nilai' . $i}->id,
            ]);
        }

        $data = AlternatifModel::all();
        $kriteria = KriteriaModel::all();
        $alt = AlternatifModel::all()->sortBy('urutan');
        foreach ($alt as $key) {
            $alternatif[] = $key;
        }
        // dd($subrelation);
        $kriteriaCount = KriteriaModel::count();
        $alternatifCount = AlternatifModel::count();
        // dd($subKriteria);

        for ($i = 0; $i < $kriteriaCount; $i++) {
            ${'kriteria' . $i} = $kriteria->get($i);
            $kriteriaJenis[] =  ${'kriteria' . $i}->jenis_kriteria;
        }

        for ($i = 0; $i < $kriteriaCount; $i++) {
            ${'kriteria' . $i} = $kriteria->get($i);
            $kriteriaKode[] =  ${'kriteria' . $i}->kode_kriteria;
        }

        for ($i = 0; $i < $alternatifCount; $i++) {
            ${'alternatif' . $i} = $alternatif[$i];
            $alternatifJenis[] =  ${'alternatif' . $i}->nama;
        }

        for ($i = 0; $i < $alternatifCount; $i++) {
            ${'alternatif' . $i} =  $alternatif[$i];
            $alternatifKode[] =  ${'alternatif' . $i}->kode_alternatif;
        }

        $penilaian = PenilaianModel::all();
        return redirect()->route('alternatif', [
            'data' => $data,
            'kriteria' => $kriteriaJenis,
            'kriteriaCount' => $kriteriaCount,
            'kriteriaKode' => $kriteriaKode,
            'alternatif' => $alternatifJenis,
            'alternatifCount' => $alternatifCount,
            'alternatifKode' => $alternatifKode,
            'penilaian' => $penilaian,
        ]);
    }
    public function editPenilaian($alternatif)
    {
        for ($i = 1; $i <= KriteriaModel::count(); $i++) {
            # code...
            $get[] = PenilaianModel::where('kode_alternatif', $alternatif)
                ->where('kode_kriteria', 'C' . $i)
                ->first();
        }
        // dd($get);
        foreach ($get as $key) {
            $data[] = $key->nilai;
        }

        return response()->json($data);
    }

    public function updatePenilaian(Request $request)
    {
        // dd($request);
        $kode = $request->kode_alternatif_edit_penilaian;
        for ($i = 1; $i <=  KriteriaModel::count(); $i++) {
            // ${'nilai' . $i} = subKriteriaModel::where('keterangan', $request->{'kriteriaEdit' . $i})->first();
            PenilaianModel::where('kode_alternatif', $kode)
                ->where('kode_kriteria', 'C' . $i)
                ->update([
                    // 'kode_alternatif' => $request->kode_alternatif_edit,
                    // 'kode_kriteria' => 'C' . $i,
                    'nilai' => $request->{'kriteriaEdit' . $i},
                    // 'sub_kriteria' =>  ${'nilai' . $i}->id,
                ]);
            // dd(${'nilai' . $i});
        }

        $data = AlternatifModel::all();
        $kriteria = KriteriaModel::all();
        $alt = AlternatifModel::all()->sortBy('urutan');
        foreach ($alt as $key) {
            $alternatif[] = $key;
        }
        // dd($subrelation);
        $kriteriaCount = KriteriaModel::count();
        $alternatifCount = AlternatifModel::count();
        // dd($subKriteria);

        for ($i = 0; $i < $kriteriaCount; $i++) {
            ${'kriteria' . $i} = $kriteria->get($i);
            $kriteriaJenis[] =  ${'kriteria' . $i}->jenis_kriteria;
        }

        for ($i = 0; $i < $kriteriaCount; $i++) {
            ${'kriteria' . $i} = $kriteria->get($i);
            $kriteriaKode[] =  ${'kriteria' . $i}->kode_kriteria;
        }

        for ($i = 0; $i < $alternatifCount; $i++) {
            ${'alternatif' . $i} = $alternatif[$i];
            $alternatifJenis[] =  ${'alternatif' . $i}->nama;
        }

        for ($i = 0; $i < $alternatifCount; $i++) {
            ${'alternatif' . $i} =  $alternatif[$i];
            $alternatifKode[] =  ${'alternatif' . $i}->kode_alternatif;
        }

        $penilaian = PenilaianModel::all();
        return redirect()->route('alternatif', [
            'data' => $data,
            'kriteria' => $kriteriaJenis,
            'kriteriaCount' => $kriteriaCount,
            'kriteriaKode' => $kriteriaKode,
            'alternatif' => $alternatifJenis,
            'alternatifCount' => $alternatifCount,
            'alternatifKode' => $alternatifKode,
            'penilaian' => $penilaian,
        ]);
    }

    public function indexPerhitungan()
    {
        $kriteria = KriteriaModel::all();
        $alt = AlternatifModel::all()->sortBy('urutan');
        foreach ($alt as $key) {
            $alternatif[] = $key;
        }
        // $alternatif = (object) $alternatif;
        // $subKriteria = subKriteriaModel::all();
        $penilaian = PenilaianModel::all();

        //Validasi Data Null .Jika null maka akan dilempar ke halaman sebelumnya
        if ($kriteria == null || $alt == null || $penilaian == null) {
            // dd('disatu');
            return redirect()->back()->withErrors(['message' => 'isi Kriteria dan Alternatif Terlebih dahulu']);
        }

        $kriteriaCount = KriteriaModel::count();
        $alternatifCount = AlternatifModel::count();


        // GET JENIS KRITERIA
        for ($i = 0; $i < $kriteriaCount; $i++) {
            ${'kriteria' . $i} = $kriteria->get($i);
            $kriteriaJenis[] =  ${'kriteria' . $i}->jenis_kriteria;
        }
        // GET KODE KRITERIA
        for ($i = 0; $i < $kriteriaCount; $i++) {
            ${'kriteria' . $i} = $kriteria->get($i);
            $kriteriaKode[] =  ${'kriteria' . $i}->kode_kriteria;
        }

        // GET NAMA Alternatif Supplier
        for ($i = 0; $i < $alternatifCount; $i++) {
            ${'alternatif' . $i} = $alternatif[$i];
            $alternatifJenis[] =  ${'alternatif' . $i}->produk->nama_vendor;
        }

        // GET NAMA Alternatif Produk
        for ($i = 0; $i < $alternatifCount; $i++) {
            ${'alternatif' . $i} = $alternatif[$i];
            $alternatifProduk[] =  ${'alternatif' . $i}->produk->nama_produk;
        }

        // dd($alternatifJenis, $alternatifProduk);
        // GET KODE Alternatif
        for ($i = 0; $i < $alternatifCount; $i++) {
            ${'alternatif' . $i} = $alternatif[$i];
            $alternatifKode[] =  ${'alternatif' . $i}->kode_alternatif;
        }

        //Cek Data Penilaian yang Null, Jika null maka akan dilempar ke halaman sebelumnya
        for ($i = 0; $i < $alternatifCount; $i++) {
            for ($j = 0; $j < $kriteriaCount; $j++) {
                if (PenilaianModel::where('kode_alternatif', $alternatifKode[$i])->where('kode_kriteria', $kriteriaKode[$j])->first() == null) {
                    // dd('didua');
                    return redirect()->back()->withErrors(['message' => 'isi Penilaian untuk setiap alternatif terlebih dahulu']);
                }
            }
        }


        //Matrix Keputusan Normalisasi
        for ($i = 0; $i < $kriteriaCount; $i++) {
            ${'pembagi' . $i} = 0;
            ${'test' . $i} = 0;
            $penilaian = PenilaianModel::where('kode_kriteria', $kriteriaKode[$i])->get();
            foreach ($penilaian as $key) {
                ${'pembagi' . $i} = ${'pembagi' . $i} +  pow($key->nilai, 2);
                ${'test' . $i} =  ${'test' . $i} + pow($key->nilai, 2);
            }
            ${'pembagi' . $i} = sqrt(${'pembagi' . $i});
        }

        for ($j = 0; $j < $alternatifCount; $j++) {
            for ($i = 0; $i < $kriteriaCount; $i++) {
                $penilaian = PenilaianModel::where('kode_alternatif', $alternatifKode[$j])->where('kode_kriteria', $kriteriaKode[$i])->first();
                ${'dataMatrix_' . $j}[] = $penilaian->nilai / ${'pembagi' . $i};
                // dd(${'dataMatrix_' . $j . '_' . $i});
            }
        }

        for ($j = 0; $j < $alternatifCount; $j++) {
            if (${'dataMatrix_' . $j} != null) {
                $dataMatrix[] =  ${'dataMatrix_' . $j};
            } else {
            }
        }

        //Matrix Keputusan Normalisasi dan Terbobot
        for ($j = 0; $j < $alternatifCount; $j++) {
            for ($i = 0; $i < $kriteriaCount; $i++) {
                $bobot = KriteriaModel::where('kode_kriteria', $kriteriaKode[$i])->first();
                ${'dataMatrix2_' . $j}[] = $bobot->bobot *  $dataMatrix[$j][$i];
                // dd(${'dataMatrix2_' . $j});
            }
        }
        for ($j = 0; $j < $alternatifCount; $j++) {
            if (${'dataMatrix2_' . $j} != null) {
                $dataMatrix2[] =  ${'dataMatrix2_' . $j};
            } else {
            }
        }
        //$dataMatrix2

        //Mencari nilai solusi ideal Maks Positif dan Min Negatif
        $transposedMatrix = array_map(null, ...$dataMatrix2);
        $justNumber = 1;
        foreach ($transposedMatrix as $column) {
            $condition  = KriteriaModel::where('kode_kriteria', 'C' . $justNumber)->first();
            if ($condition->keterangan == 'cost') {
                $maxValues[] = min($column);
                $minValues[] = max($column);
            } elseif ($condition->keterangan == 'benefit') {
                $maxValues[] = max($column);
                $minValues[] = min($column);
            }
            $justNumber =  $justNumber + 1;
        }

        //D- dan D+
        //D+
        for ($i = 0; $i < $alternatifCount; $i++) {
            ${'D_plus' . $i} = 0;
            for ($j = 0; $j < $kriteriaCount; $j++) {
                ${'D_plus' . $i . $j} = pow($maxValues[$j] - $dataMatrix2[$i][$j], 2);

                ${'D_plus' . $i} = ${'D_plus' . $i} + ${'D_plus' . $i . $j};
            }
            ${'D_plus' . $i} = sqrt(${'D_plus' . $i});
            $D_plus[] =   ${'D_plus' . $i};
        }


        //D-
        for ($i = 0; $i < $alternatifCount; $i++) {
            ${'D_min' . $i} = 0;
            for ($j = 0; $j < $kriteriaCount; $j++) {
                ${'D_min' . $i . $j} = pow($minValues[$j] - $dataMatrix2[$i][$j], 2);

                ${'D_min' . $i} = ${'D_min' . $i} + ${'D_min' . $i . $j};
            }
            ${'D_min' . $i} = sqrt(${'D_min' . $i});
            $D_min[] =   ${'D_min' . $i};
        }

        // dd($D_plus, $D_min);

        //Nilai Preferensi
        for ($i = 0; $i < $alternatifCount; $i++) {
            $nilaiQi[] = $D_min[$i] / ($D_plus[$i] + $D_min[$i]);
        }

        for ($i = 0; $i < count($alternatifJenis); $i++) {
            $summary[] = [
                'Supplier' => $alternatifJenis[$i],
                'Produk' => $alternatifProduk[$i],
                'Nilai' => $nilaiQi[$i]
            ];
        }
        //Perankingan
        usort($summary, function ($a, $b) {
            return $b['Nilai'] <=> $a['Nilai'];
        });
        // dd($summary);

        return view('perhitungan', [
            'kriteria' => $kriteriaJenis,
            'kriteriaCount' => $kriteriaCount,
            'kriteriaKode' => $kriteriaKode,
            'penilaian' => $penilaian,
            'dataMatrix' => $dataMatrix,
            'dataMatrix2' => $dataMatrix2,
            'max' => $maxValues,
            'min' => $minValues,
            'D_plus' => $D_plus,
            'D_min' => $D_min,
            'dataCountMatrix' => count($dataMatrix),
            'dataCountMatrix2' => count($dataMatrix2),
            'nilaiQi' => $nilaiQi,
            'rank' => $summary,
            'alternatif' => $alternatifJenis,
            'alternatifProduk' => $alternatifProduk,
            'alternatifCount' => $alternatifCount,
            'alternatifKode' => $alternatifKode,
            // 'subKriteria' => $subKriteria
        ]);
    }

    public function hasil(Request $request)
    {
        $kriteria = KriteriaModel::all();
        $alt = AlternatifModel::all()->sortBy('urutan');
        foreach ($alt as $key) {
            $alternatif[] = $key;
        }
        // $alternatif = (object) $alternatif;
        $subKriteria = subKriteriaModel::all();
        $penilaian = PenilaianModel::all();

        // dd($subrelation);
        $kriteriaCount = KriteriaModel::count();
        $alternatifCount = AlternatifModel::count();

        // dd($alternatif);

        // GET JENIS KRITERIA
        for ($i = 0; $i < $kriteriaCount; $i++) {
            ${'kriteria' . $i} = $kriteria->get($i);
            $kriteriaJenis[] =  ${'kriteria' . $i}->jenis_kriteria;
        }
        // GET KODE KRITERIA
        for ($i = 0; $i < $kriteriaCount; $i++) {
            ${'kriteria' . $i} = $kriteria->get($i);
            $kriteriaKode[] =  ${'kriteria' . $i}->kode_kriteria;
        }

        // GET NAMA GURU
        for ($i = 0; $i < $alternatifCount; $i++) {
            ${'alternatif' . $i} = $alternatif[$i];
            $alternatifJenis[] =  ${'alternatif' . $i}->nama;
        }

        // GET KODE GURU
        for ($i = 0; $i < $alternatifCount; $i++) {
            ${'alternatif' . $i} = $alternatif[$i];
            $alternatifKode[] =  ${'alternatif' . $i}->kode_alternatif;
        }

        // NORMALISASI
        for ($j = 1; $j <= $alternatifCount; $j++) {
            $first = collect($penilaian->where('kode_alternatif', 'A' . $j)->all());
            for ($i = 1; $i <= $kriteriaCount; $i++) {
                $seleksi = $kriteria->where('kode_kriteria', 'C' . $i)->first();
                ${'C' . $i . '_' . $j} = $penilaian->where('kode_kriteria', 'C' . $i)->first();
                ${'x' .  $i . '_' . $j} = $first->where('kode_kriteria', 'C' . $i)->first();
                if ($seleksi->keterangan == 'BENEFIT') {

                    ${'dataNormal' . $j}[] = ${'x' .  $i . '_' . $j}->nilai /  $penilaian->where('kode_kriteria', 'C' . $i)->max('nilai');
                    // ${'data' . $j}[] = ${'dataNormal' . $i};
                    // dd(${'C' . $i . '_' . $j}->min('nilai'));
                } else {
                    ${'dataNormal' . $j}[] = ${'C' . $i . '_' . $j}->min('nilai') / ${'x' .  $i . '_' . $j}->nilai;
                }
            }
        }

        for ($j = 1; $j <= $alternatifCount; $j++) {
            $data[] =  ${'dataNormal' . $j};
            // dd($j);
        }

        return view('hasil', [
            'kriteria' => $kriteriaJenis,
            'kriteriaCount' => $kriteriaCount,
            'kriteriaKode' => $kriteriaKode,
            'penilaian' => $penilaian,

            'NilaiQi' => $qi,


            'alternatif' => $alternatifJenis,
            'alternatifCount' => $alternatifCount,
            'alternatifKode' => $alternatifKode,
            'subKriteria' => $subKriteria
        ]);
    }
}
