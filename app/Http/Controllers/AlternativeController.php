<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    public function index()
    {
        $data = AlternatifModel::all();
        return view('alternatif', [
            'alternatif' => $data
        ]);
    }

    public function tambahAlternatif(Request $request)
    {
        $x =  $request->kode_alternatif;
        // dd($x);
        AlternatifModel::create([
            'kode_Alternatif' => $x,
            'nama_vendor' => $request->nama_vendor
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
                'nama_vendor' => $request->nama_vendor
            ]);

        return Redirect("/alternatif");
    }


    public function destroy($kode)
    {
        $data = AlternatifModel::all();

        $delete = $data->where('kode_alternatif', $kode)->first();
        $delete->delete();

        return view('alternatif', [
            'alternatif' => $data
        ]);
    }
}
