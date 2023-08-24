<?php

namespace App\Http\Controllers;

use App\Models\DbRequestModel;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\ProdukModel;
use DbRequest;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        $dbRequest = DbRequestModel::all();
        $kriteria = KriteriaModel::all();
        $alt = AlternatifModel::all()->sortBy('urutan');
        // dd($alt);
        foreach ($alt as $key) {
            $alternatif[] = $key;
        }
        // $alternatif = (object) $alternatif;
        // $subKriteria = subKriteriaModel::all();
        $penilaian = PenilaianModel::all();

        //Validasi Data Null .Jika null maka akan dilempar ke halaman sebelumnya
        if ($kriteria == null || $alt == null || $penilaian == null || $kriteria->count() <= 1 || $alt->count() <= 1 || $penilaian->count() <= 1) {
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
            $alternatifProduk[] =  ${'alternatif' . $i}->kode_produk;
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
                'Nilai' => number_format($nilaiQi[$i], 2)
            ];
        }
        //Perankingan
        usort($summary, function ($a, $b) {
            return $b['Nilai'] <=> $a['Nilai'];
        });
        $summary = collect($summary);
        $produkTerpilih = $summary->first();
        $hargaSatuan = ProdukModel::where('kode_produk', $produkTerpilih['Produk'])->first();
        // dd($summary->first());
        $hargaSatuan = $hargaSatuan->harga;
        return view('suratPengajuan', compact('dbRequest', 'produkTerpilih', 'hargaSatuan'));
    }

    public function submitRequest(Request $request)
    {
        DbRequestModel::create([
            'no_request' => $request->no_request,
            'kode_produk' => $request->kode_produk,
            'diskon' => $request->diskon,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->harga_satuan,
            'ppn' => $request->ppn,
            'total_akhir' => $request->total_akhir

        ]);
        return redirect()->route('surat');
    }

    public function editPengajuan($kode)
    {
        $data = DbRequestModel::where('no_request', $kode)->first();
        return response()->json($data);
    }

    public function updatePengajuan(Request $request)
    {

        $data = DbRequestModel::where('no_request', $request->no_request)->first();
        // dd($data);
        $data->update([
            // 'no_request' => $request->no_request,
            'kode_produk' => $request->kode_produk,
            'diskon' => $request->diskon,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->harga_satuan,
            'ppn' => $request->ppn,
            'total_akhir' => $request->total_akhir
        ]);
        return redirect()->route('surat');
    }

    public function destroy($kode)
    {
        $data = DbRequestModel::all();

        $delete = $data->where('no_request', $kode)->first();
        $delete->delete();
    }

    public function indexValidasi()
    {
        $dbRequest = DbRequestModel::paginate(10);
        return view('validasi', compact('dbRequest'));
    }

    public function modalDecline($kode)
    {
        $data = DbRequestModel::where('no_request', $kode)->first();
        return view('modal.modalDecline', compact('kode'));
    }

    public function submitModalDecline(Request $request, $kode)
    {
        $data = DbRequestModel::where('no_request', $kode)->first();
        $data->update([
            'notes' => $request->notes_for_decline
        ]);
        $dbRequest = DbRequestModel::all();
        return redirect()->route('suratValidasi', compact('dbRequest'));
    }

    public function validasiPengajuan($kode)
    {
        $data = DbRequestModel::where('no_request', $kode)->first();
        $data->update([
            'validasi' => date('Y-m-d')
        ]);
        // $dbRequest = DbRequestModel::all();
        // return redirect()->route('suratValidasi', compact('dbRequest'));
    }
}
