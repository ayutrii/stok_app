<?php

namespace App\Http\Controllers;

use App\Models\barangKeluar;
use App\Models\barangMasuk;
use App\Models\pelanggan;
use App\Models\stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class barangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Barang.BarangKeluar.barangKeluar');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = barangKeluar::all();
        $lastId = barangKeluar::max('id');
        $lastId = $lastId ? $lastId : 0;
        if ($data->isEmpty()) {
            $nextId = $lastId + 1;
            $date = now()->format('d/m/Y');
            $kode_transaksi = 'TRK' . $nextId . '/' . $date;
            $pelanggan = pelanggan::all();

            return view('Barang.BarangKeluar.addBarangKeluar', compact(
                'data',
                'kode_transaksi',
                'pelanggan'
            ));
        }

        $latestItem = barangKeluar::latest()->first();
        $id = $latestItem->id;
        $date = $latestItem->created_at->format('d/m/Y');
        $kode_transaksi = 'TRK' . ($id+1) . '/' . $date;
        $pelanggan = pelanggan::all();

        return view('Barang.BarangKeluar.addBarangKeluar', compact(
            'data',
            'kode_transaksi',
            'pelanggan'
        ));

        return view('Barang.BarangKeluar.addBarangKeluar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_faktur' => 'required',
            'tgl_jatuh_tempo' => 'required',
            'pelanggan_id' => 'required',
            'jenis_pembayaran' => 'required',
        ],[
            'tgl_faktur.required' => 'Data wajib diisi',
            'tgl_jatuh_tempo.required' => 'Data wajib diisi',
            'pelanggan_id.required' => 'Data wajib diisi',
            'jenis_pembayaran.required' => 'Data wajib diisi',
        ]);

        $kode_transaksi = $request->kode_transaksi;
        $tgl_faktur = $request->tgl_faktur;
        $tgl_jatuh_tempo = $request->tgl_jatuh_tempo;
        $pelanggan_id = $request->pelanggan_id;

        $getNamaPelanggan = pelanggan::find($pelanggan_id);
        $namaPelanggan = $getNamaPelanggan->nama_pelanggan;
        $jenis_pembayaran = $request->jenis_pembayaran;

        $getBarang = stok::all();

        return view('Transaksi.transaksi', compact(
            'kode_transaksi',
            'tgl_faktur',
            'tgl_jatuh_tempo',
            'pelanggan_id',
            'namaPelanggan',
            'jenis_pembayaran',
            'getBarang',
        ));
    }

    public function saveProcess(Request $request){
        $request->validate([
            'kode_transaksi' => 'required',
            'tgl_faktur' => 'required',
            'tgl_jatuh_tempo' => 'required',
            'pelanggan_id'  => 'required',
            'jenis_pembayaran'  => 'required',
            'barang_id'  => 'required',
            'jumlah_beli'  => 'required',
            'harga_jual'  => 'required',

        ],[
            'kode_transaksi.required' => 'Data wajib diisi',
            'tgl_faktur.required' => 'Data wajib diisi',
            'tgl_jatuh_tempo.required' => 'Data wajib diisi',
            'pelanggan_id.required' => 'Data wajib diisi',
            'jenis_pembayaran.required' => 'Data wajib diisi',
            'barang_id.required' => 'Data wajib diisi',
            'jumlah_beli.required' => 'Data wajib diisi',
            'harga_jual.required' => 'Data wajib diisi',
        ]);

        $save = new barangKeluar();
        $save->kode_transaksi = $request->kode_transaksi;
        $save->tgl_faktur = $request->tgl_faktur;
        $save->tgl_jatuh_tempo = $request->tgl_jatuh_tempo;
        $save->pelanggan_id = $request->pelanggan_id;
        $save->jenis_pembayaran = $request->jenis_pembayaran;
        $save->barang_id = $request->barang_id;
        $save->jumlah_beli = $request->jumlah_beli;

        //update jumlah stok yang ada didalam database stok
        $getStokData = stok::find($request->barang_id);
            $getSumStokNow = $getStokData->stok;
        $getStokData->stok = $getSumStokNow - $request->jumlah_beli;
        $getStokData->save();
        
        $save->harga_jual = $request->harga_jual;

        $diskon = $request->diskon;
        $nilaiDiskon = $diskon/100;

        if ($diskon) {
            $save->diskon = $request->diskon;
                $hitung = $request->jumlah_beli * $request->harga_jual;
                $totalDiskon = $hitung * $nilaiDiskon;
                $subTotal = $hitung - $totalDiskon;

            $save->sub_total = $subTotal;
        } else {
            $hitung =$request->jumlah_beli * $request->harga_jual;
            $save->sub_total = $hitung;
        }

        $save->user_id = Auth::user()->id;
        $save->tgl_buat = $request->tgl_faktur;
        $save->save();

        return redirect('/barang-keluar')->with(
            'message',
            'Berhasil input barang keluar'
        );


    }

   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
