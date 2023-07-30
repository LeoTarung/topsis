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
    public function index()
    {
        $kriteria = KriteriaModel::all();
        $alt = AlternatifModel::all()->sortBy('urutan');
        foreach ($alt as $key) {
            $alternatif[] = $key;
        }
        // dd($alternatif);
        $subKriteria = subKriteriaModel::all();
        $penilaian = PenilaianModel::all();

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
            $alternatifJenis[] =  ${'alternatif' . $i}->nama_vendor;
        }

        for ($i = 0; $i < $alternatifCount; $i++) {
            ${'alternatif' . $i} =  $alternatif[$i];
            $alternatifKode[] =  ${'alternatif' . $i}->kode_alternatif;
        }
        // dd($alternatifJenis);
        // foreach ($penilaian as $key) {
        //     $test[] = $key->nilai;
        //     # code...
        // }
        // dd($test);
        // dd($penilaian->where('kode_alternatif', $alternatifKode[3])->where('kode_kriteria', $kriteriaKode[3 + 1])->first());
        // dd($alternatifJenis);
        return view('penilaian', [
            'kriteria' => $kriteriaJenis,
            'kriteriaCount' => $kriteriaCount,
            'kriteriaKode' => $kriteriaKode,
            'penilaian' => $penilaian,

            'alternatif' => $alternatifJenis,
            'alternatifCount' => $alternatifCount,
            'alternatifKode' => $alternatifKode,
            'subKriteria' => $subKriteria
        ]);
    }

    public function tambahPenilaian(Request $request)
    {
        // $nilai = subKriteriaModel::where('keterangan', $request->kriteria2)->first();
        // dd($nilai->nilai);

        for ($i = 1; $i <=  $kriteriaCount = KriteriaModel::count(); $i++) {
            ${'nilai' . $i} = subKriteriaModel::where('range', $request->{'kriteria' . $i})->first();
            PenilaianModel::create([
                'kode_alternatif' => $request->kode_alternatif,
                'kode_kriteria' => 'C' . $i,
                'nilai' => ${'nilai' . $i}->nilai,
                'sub_kriteria' =>  ${'nilai' . $i}->id,
            ]);
        }
        return Redirect("/penilaian");
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
            $data[] = $key->sub->keterangan;
        }

        return response()->json($data);
    }

    public function updatePenilaian(Request $request)
    {
        // dd($request);
        $alternatif = $request->kode_alternatif_edit;
        for ($i = 1; $i <=  $kriteriaCount = KriteriaModel::count(); $i++) {
            ${'nilai' . $i} = subKriteriaModel::where('keterangan', $request->{'kriteriaEdit' . $i})->first();
            PenilaianModel::where('kode_alternatif', $alternatif)
                ->where('kode_kriteria', 'C' . $i)
                ->update([
                    // 'kode_alternatif' => $request->kode_alternatif_edit,
                    // 'kode_kriteria' => 'C' . $i,
                    'nilai' => ${'nilai' . $i}->nilai,
                    'sub_kriteria' =>  ${'nilai' . $i}->id,
                ]);
            // dd(${'nilai' . $i});
        }
        return Redirect("/penilaian");
    }

    public function indexPerhitungan()
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

        // GET NAMA VENDOR
        for ($i = 0; $i < $alternatifCount; $i++) {
            ${'alternatif' . $i} = $alternatif[$i];
            $alternatifJenis[] =  ${'alternatif' . $i}->nama_vendor;
        }

        // GET KODE VENDOR
        for ($i = 0; $i < $alternatifCount; $i++) {
            ${'alternatif' . $i} = $alternatif[$i];
            $alternatifKode[] =  ${'alternatif' . $i}->kode_alternatif;
        }

        // NORMALISASI
        for ($j = 1; $j <= $alternatifCount; $j++) {
            // dd(collect($penilaian->where('kode_alternatif', 'A' . 2)->all()));


            $first = collect($penilaian->where('kode_alternatif', 'A' . $j)->all());
            if ($first->first() != null) {
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
            } else {
                ${'dataNormal' . $j} = null;
            }
        }

        for ($j = 1; $j <= $alternatifCount; $j++) {
            if (${'dataNormal' . $j} != null) {
                $data[] =  ${'dataNormal' . $j};
            } else {
            }
        }
        // dd($data);
        // Mencari Nilai Qi
        // dd($alternatifCount);

        //------------- [ Khusus untuk Waspas, klo gk kepake apus aja ya ]-----------------//
        // for ($j = 1; $j <= count($data); $j++) {
        //     for ($i = 1; $i <= $kriteriaCount; $i++) {
        //         ${'bobot' .  $i . '_' . $j} = $kriteria->where('kode_kriteria', 'C' . $i)->first();

        //         ${'timesQ' .  $i . '_' . $j} =  ${'bobot' .  $i . '_' . $j}->bobot * $data[$j - 1][$i - 1];

        //         ${'powQ' .  $i . '_' . $j} =  pow($data[$j - 1][$i - 1], ${'bobot' .  $i . '_' . $j}->bobot);
        //     }


        //     ${'times2Q' . $j} =  ${'timesQ' . 1 . '_' . $j};
        //     ${'pow2Q' . $j} =  ${'powQ' . 1 . '_' . $j};
        //     for ($k = 2; $k <= $kriteriaCount; $k++) {
        //         ${'times2Q' . $j} =   ${'times2Q' . $j} + ${'timesQ' .  $k . '_' . $j};
        //         ${'pow2Q' . $j} =   ${'pow2Q' . $j} * ${'powQ' .  $k . '_' . $j};
        //     }
        //     ${'Q' . $j} = (${'times2Q' . $j} * 0.5) + (${'pow2Q' . $j} * 0.5);
        // }


        // for ($j = 1; $j <= count($data); $j++) {
        //     $dataQi[] =  ${'Q' . $j};
        // }

        // dd($dataQi);
        //------------- []-----------------//

        //------------- [Perhitungan akhir Bobot dikalikan dengan hasil normalisasi masing-masing ]-----------------//
        for ($j = 1; $j <= count($data); $j++) {
            ${'hasilRank' . $j} = 0;
            for ($i = 1; $i <= $kriteriaCount; $i++) {
                ${'bobot' .  $i . '_' . $j} = $kriteria->where('kode_kriteria', 'C' . $i)->first();

                ${'timesQ' .  $i . '_' . $j} =  ${'bobot' .  $i . '_' . $j}->bobot * $data[$j - 1][$i - 1];
                ${'dataRank' . $j}[] =   ${'timesQ' .  $i . '_' . $j};
                ${'hasilRank' . $j} =  ${'hasilRank' . $j} +  ${'timesQ' .  $i . '_' . $j};
            }
        }

        for ($j = 1; $j <= $alternatifCount; $j++) {
            if (${'dataNormal' . $j} != null) {
                $rank[] = ${'dataRank' . $j};
                $hasil[] = ${'hasilRank' . $j};
            } else {
            }
        }


        return view('perhitungan', [
            'kriteria' => $kriteriaJenis,
            'kriteriaCount' => $kriteriaCount,
            'kriteriaKode' => $kriteriaKode,
            'penilaian' => $penilaian,
            'data' => $data,
            'hasil' => $hasil,
            // 'dataQi' => $dataQi,
            'dataCount' => count($data),
            'rank' => $rank,
            'alternatif' => $alternatifJenis,
            'alternatifCount' => $alternatifCount,
            'alternatifKode' => $alternatifKode,
            'subKriteria' => $subKriteria
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
            $alternatifJenis[] =  ${'alternatif' . $i}->nama_vendor;
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

        // Mencari Nilai Qi
        // dd($data);
        // for ($j = 1; $j <= $alternatifCount; $j++) {
        //     for ($i = 1; $i <= $kriteriaCount; $i++) {

        //         ${'bobot' .  $i . '_' . $j} = $kriteria->where('kode_kriteria', 'C' . $i)->first();

        //         ${'timesQ' .  $i . '_' . $j} =  ${'bobot' .  $i . '_' . $j}->bobot * $data[$j - 1][$i - 1];

        //         ${'powQ' .  $i . '_' . $j} =  pow($data[$j - 1][$i - 1], ${'bobot' .  $i . '_' . $j}->bobot);
        //     }


        //     ${'times2Q' . $j} =  ${'timesQ' . 1 . '_' . $j};
        //     ${'pow2Q' . $j} =  ${'powQ' . 1 . '_' . $j};
        //     for ($k = 2; $k <= $kriteriaCount; $k++) {
        //         ${'times2Q' . $j} =   ${'times2Q' . $j} + ${'timesQ' .  $k . '_' . $j};
        //         ${'pow2Q' . $j} =   ${'pow2Q' . $j} * ${'powQ' .  $k . '_' . $j};
        //     }
        //     ${'Q' . $j} = (${'times2Q' . $j} * 0.5) + (${'pow2Q' . $j} * 0.5);
        // }


        // for ($j = 1; $j <= $alternatifCount; $j++) {
        //     $dataQi[] =  ${'Q' . $j};
        // }

        //------------- [Perhitungan akhir Bobot dikalikan dengan hasil normalisasi masing-masing ]-----------------//
        for ($j = 1; $j <= count($data); $j++) {
            ${'hasilRank' . $j} = 0;
            for ($i = 1; $i <= $kriteriaCount; $i++) {
                ${'bobot' .  $i . '_' . $j} = $kriteria->where('kode_kriteria', 'C' . $i)->first();

                ${'timesQ' .  $i . '_' . $j} =  ${'bobot' .  $i . '_' . $j}->bobot * $data[$j - 1][$i - 1];
                ${'dataRank' . $j}[] =   ${'timesQ' .  $i . '_' . $j};
                ${'hasilRank' . $j} =  ${'hasilRank' . $j} +  ${'timesQ' .  $i . '_' . $j};
            }
        }

        for ($j = 1; $j <= $alternatifCount; $j++) {
            if (${'dataNormal' . $j} != null) {
                $rank[] = ${'dataRank' . $j};
                $hasil[] = ${'hasilRank' . $j};
            } else {
            }
        }
        // $nilaiqi = nilaiQiModel::first();
        // dd($nilaiqi);
        if (nilaiQiModel::first() == null) {
            for ($j = 1; $j <= $alternatifCount; $j++) {
                nilaiQiModel::create([
                    'kode_alternatif' => 'A' . $j,
                    'nilai_qi' => $hasil[$j - 1]
                ]);
            }
        } else {
            for ($j = 1; $j <= $alternatifCount; $j++) {
                $edit = nilaiQiModel::where('kode_alternatif', 'A' . $j);
                // dd($edit);
                $edit->update([
                    'kode_alternatif' => 'A' . $j,
                    'nilai_qi' => $hasil[$j - 1]
                ]);
            }
            // dd($edit);
        }

        $qi = nilaiQiModel::all()->sortByDesc('nilai_qi');
        // foreach ($qi as $key) {
        //     $nilaiqi[] = $key;
        // // }
        // $test = $qi->first();
        // dd($test->alternatif);


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
    public function indexPrint()
    {
        $qi = nilaiQiModel::all()->sortByDesc('nilai_qi');

        $pdf = Pdf::loadView('print',  ['NilaiQi' => $qi]);
        return $pdf->download('print.pdf');
        // return view('print', ['NilaiQi' => $qi,]);
    }
}
