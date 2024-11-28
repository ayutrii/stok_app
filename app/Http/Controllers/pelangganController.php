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
        return view('Pelanggan.pelanggan');
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
            'nama_suplier' => 'required',
            'telp' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required'
        ],[
            'nama_pelanggan.required' => 'Data Wajib Diisi!',
            'telp.required' => 'Data Wajib Diisi!',
            'jenis_kelamin.email' => 'Format email tidak sesuai!',
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
        $getPelanggan = pelanggan::find($id);
        return view('Pelanggan.editPelanggan', compact(
            'getPelanggan',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
