<?php

namespace App\Http\Controllers;

use App\Models\ProdukModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xls\RC4;

class ProdukController extends Controller
{
    public function index()
    {
        $data = ProdukModel::all();


        return view('produk', [
            'produk' => $data
        ]);
    }

    public function tambahProduk(Request $request)
    {
        $check = ProdukModel::where('kode_produk', $request->kode_produk)->first();
        if ($check != null) {
            return redirect()->back()->withErrors(['message' => 'Kode Produk Sudah Terpakai']);
        } else {
            ProdukModel::create([
                'kode_produk' => $request->kode_produk,
                'nama_vendor' => $request->nama_supplier,
                'nama_produk' => $request->nama_produk,
                'alamat' => $request->alamat,
                'kota' => $request->kota,
                'harga' => $request->harga
            ]);
            return redirect("/produk");
        }
    }


    public function editProduk($kode)
    {
        $data = ProdukModel::where('kode_produk', $kode)->first();
        return response()->json($data);
    }

    public function updateProduk(Request $request)
    {
        $produk = ProdukModel::where('kode_produk', $request->kode_produk_edit)->first();
        $produk->update([
            'kode_produk' => $request->kode_produk_edit,
            'nama_vendor' => $request->nama_supplier_edit,
            'nama_produk' => $request->nama_produk_edit,
            'alamat' => $request->alamat_edit,
            'kota' => $request->kota_edit,
            'harga' => $request->harga_edit
        ]);

        return redirect("/produk");
    }

    public function destroy($kode)
    {
        $data = ProdukModel::all();

        $delete = $data->where('kode_produk', $kode)->first();
        $delete->delete();

        // return redirect("/produk");
    }
}
