<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;

class pelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getData = pelanggan::paginate();
        return view('Pelanggan.pelanggan', compact(
            'getData',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('Pelanggan.addPelanggan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valueData = $request->validate([
            'nama_pelanggan' => 'required',
            'telp' => 'required',
            'Jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required'
        ],[
            'nama_pelanggan.required' => 'Data Wajib Diisi!',
            'telp.required' => 'Data Wajib Diisi!',
            'Jenis_kelamin.required' => 'Data Wajib Diisi!',
            'alamat.required' => 'Data Wajib Diisi!',
            'kota.required' => 'Data Wajib Diisi!',
            'provinsi.required' => 'Data Wajib Diisi!',
        ]);

        pelanggan::create($valueData);

        return redirect('/pelanggan')->with(
            'message',
            '' . $request->nama_pelanggan . ' berhasil terdaftar'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $getData = pelanggan::find($id);
        return view('Pelanggan.editPelanggan', compact(
            'getData',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'telp' => 'required',
            'Jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
        ],[
            'nama_pelanggan.required' => 'Data Wajib Diisi!',
            'telp.required' => 'Data Wajib Diisi!',
            'Jenis_kelamin.required' => 'Data Wajib Diisi!',
            'alamat.required' => 'Data Wajib Diisi!',
            'kota.required' => 'Data Wajib Diisi!',
            'provinsi.required' => 'Data Wajib Diisi!',
        ]);

        $updatePelanggan = pelanggan::find($id);
        $updatePelanggan->nama_pelanggan = $request->nama_pelanggan;
        $updatePelanggan->telp = $request->telp;
        $updatePelanggan->Jenis_kelamin = $request->Jenis_kelamin;
        $updatePelanggan->alamat = $request->alamat;
        $updatePelanggan->kota = $request->kota;
        $updatePelanggan->provinsi = $request->provinsi;
        $updatePelanggan->save();

        return redirect('/pelanggan')->with(
             'message',
             'Data pelanggan' . $request->nama_pelanggan . ' Berhasil diperbaharui'
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
