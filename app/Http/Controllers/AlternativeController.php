<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\ProdukModel;

class AlternativeController extends Controller
{
    public function index()
    {
        $data = AlternatifModel::all();
        $kriteria = KriteriaModel::all();
        $produk = ProdukModel::all();
        if ($kriteria->first() == null) {
            return redirect()->route('kriteria',  ['kriteria' => $data]);
        }
        if ($data->first() == null) {
            // dd($data); 
            $alternatifKode = 0;
            $alternatifJenis = 0;
            $alternatifCount = 0;
            $kriteriaCount = KriteriaModel::count();
            for ($i = 0; $i < $kriteriaCount; $i++) {
                ${'kriteria' . $i} = $kriteria->get($i);
                $kriteriaJenis[] =  ${'kriteria' . $i}->jenis_kriteria;
            }

            for ($i = 0; $i < $kriteriaCount; $i++) {
                ${'kriteria' . $i} = $kriteria->get($i);
                $kriteriaKode[] =  ${'kriteria' . $i}->kode_kriteria;
            }
            $penilaian = PenilaianModel::all();
        } else {
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
                $alternatifJenis[] =  ${'alternatif' . $i}->produk->nama_vendor;
            }

            for ($i = 0; $i < $alternatifCount; $i++) {
                ${'alternatif' . $i} =  $alternatif[$i];
                $alternatifKode[] =  ${'alternatif' . $i}->kode_alternatif;
            }

            $penilaian = PenilaianModel::all();
        }

        return view('alternatif', [
            'data' => $data,
            'kriteria' => $kriteriaJenis,
            'kriteriaCount' => $kriteriaCount,
            'kriteriaKode' => $kriteriaKode,
            'alternatif' => $alternatifJenis,
            'alternatifCount' => $alternatifCount,
            'alternatifKode' => $alternatifKode,
            'penilaian' => $penilaian,
            'produk' => $produk,
        ]);
    }

    public function tambahAlternatif(Request $request)
    {
        $x =  $request->kode_alternatif;
        // dd($x);
        AlternatifModel::create([
            'kode_Alternatif' => $x,
            // 'nama' => $request->nama,
            'kode_produk' => $request->kode_produk
        ]);
        return redirect("/alternatif");
    }

    public function editAlternatif($kode)
    {
        $data = AlternatifModel::where('kode_alternatif', $kode)->first();
        return response()->json($data);
    }

    public function updateAlternatif(Request $request)
    {

        $alternatif = $request->kode_alternatif;
        AlternatifModel::where('kode_alternatif', $alternatif)
            ->update([
                'nama' => $request->nama
            ]);

        return Redirect("/alternatif");
    }


    public function destroy($kode)
    {
        $data = AlternatifModel::all();

        $delete = $data->where('kode_alternatif', $kode)->first();
        $delete->delete();
    }
}
